<?php
namespace ExampleApp;

interface IUser {
    public function getFirstName(): string;
    public function getLastName(): string;
    public function getPhone(): string;
    public function getEmail(): string;
}