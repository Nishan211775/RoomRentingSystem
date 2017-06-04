<?php

/**
 * Created by PhpStorm.
 * User: Nishan
 * Date: 5/17/2017
 * Time: 10:39 PM
 */
class Customer
{
    private $id;
    private $firstName;
    private $lastName;
    private $username;
    private $gender;
    private $contact;
    private $address;
    private $accountType;
    private $city;

    public function Customer() {

    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function getGender() {
        return $this->gender;
    }

    public function setContact($contact) {
        $this->contact = $contact;
    }

    public function getContact() {
        return $this->contact;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAccountType($accountType) {
        $this->accountType = $accountType;
    }

    public function getAccountType() {
        return $this->accountType;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getCity() {
        return $this->city;
    }
}