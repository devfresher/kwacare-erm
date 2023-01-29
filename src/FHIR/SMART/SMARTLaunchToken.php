<?php

/**
 * SmartLaunchToken represents the opaque SMART 'launch' context values that are used to send the EHR session context
 * to the app which the app then hands back to the oauth2 authorization server.
 * @package OpenEMR\FHIR\SMART
 * @link      http://www.open-emr.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2020 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\FHIR\SMART;

use OpenEMR\Common\Crypto\CryptoGen;
use OpenEMR\Common\Logging\SystemLogger;
use OpenEMR\Common\Uuid\UuidRegistry;

class SMARTLaunchToken
{
    public const INTENT_PATIENT_DEMOGRAPHICS_DIALOG = 'patient.demographics.dialog';
    public const VALID_INTENTS = [self::INTENT_PATIENT_DEMOGRAPHICS_DIALOG];

    private $patient;
    private $intent;
    private $encounter;

    public function __construct($patientUUID = null, $encounterUUID = null)
    {
        if (isset($patientUUID) && !is_string($patientUUID)) {
            throw new \InvalidArgumentException("patientUUID must be a string");
        }
        if (isset($encounterUUID) && !is_string($encounterUUID)) {
            throw new \InvalidArgumentException("encounterUUID must be a string");
        }
        $this->patient = $patientUUID;
        $this->encounter = $encounterUUID;
    }

    /**
     * @return mixed
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * @param mixed $patient
     */
    public function setPatient($patient): void
    {
        $this->patient = $patient;
    }

    /**
     * @return mixed
     */
    public function getEncounter()
    {
        return $this->encounter;
    }

    /**
     * @param mixed $encounter
     */
    public function setEncounter($encounter): void
    {
        $this->encounter = $encounter;
    }

    /**
     * @return mixed
     */
    public function getIntent()
    {
        return $this->intent;
    }

    /**
     * @param mixed $intent
     */
    public function setIntent($intent): void
    {
        $this->intent = $intent;
    }

    public function serialize()
    {
        $context = [];
        $encounter = $this->getEncounter();
        $patient = $this->getPatient();
        $intent = $this->getIntent();
        if (!empty($encounter)) {
            $context['e'] = $encounter;
        }
        if (!empty($patient)) {
            $context['p'] = $patient;
        }
        if (!empty($intent)) {
            $context['i'] = $intent;
        }

        // no security is really needed here... just need to be able to wrap
        // the current context into some kind of opaque id that the app will pass to the server and we can then
        // return to system
        $cryptoGen = new CryptoGen();
        $jsonEncoded = json_encode($context);
        (new SystemLogger())->debug(self::class . "->serialize() Context before encryption", ['context' => $context, 'json' => $jsonEncoded]);
        $launchParams = $cryptoGen->encryptStandard($jsonEncoded);
        return $launchParams;
    }

    public static function deserializeToken($serialized)
    {
        $token = new self();
        $token->deserialize($serialized);
        return $token;
    }

    public function deserialize($serialized)
    {
        $cryptoGen = new CryptoGen();
        $jsonEncoded = $cryptoGen->decryptStandard($serialized);
        if ($jsonEncoded === false) {
            throw new \InvalidArgumentException("serialized token could not be decrypted.  Token was either invalid or something is wrong with the encryption keys");
        }

        // invalid json let it throw here
        $context = json_decode($jsonEncoded, true, 512, JSON_THROW_ON_ERROR);
        (new SystemLogger())->debug(self::class . "->deserialize() Decoded context is ", $context);
        if (!empty($context['p'])) {
            $this->setPatient($context['p']);
        }
        if (!empty($context['e'])) {
            $this->setEncounter($context['e']);
        }
        if (!empty($context['i']) && $this->isValidIntent($context['i'])) {
            $this->setIntent($context['i']);
        }
    }

    public function isValidIntent($intent)
    {
        return array_search($intent, self::VALID_INTENTS) !== false;
    }
}
