<?php

namespace App;

use PDO;
use PDOException;

class Pet
{
    protected $id;
    protected $name;
    protected $breed;
    protected $birthdate;
    protected $ownerName;
    protected $gender;
    protected $address;
    protected $email;
    protected $contact_number;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getBreed()
    {
        return $this->breed;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function getOwnerName()
    {
        return $this->ownerName;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getContactNumber()
    {
        return $this->contact_number;
    }

    public static function listAll()
    {
        global $conn;

        try {
            $sql = "SELECT * FROM pets";
            $statement = $conn->query($sql);

            $pets = [];
            while ($row = $statement->fetchObject('App\Pet')) {
                array_push($pets, $row);
            }

            return $pets;
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }

    public static function getById($id)
    {
        global $conn;

        try {
            $sql = "SELECT * FROM pets WHERE id = :id";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $row = $statement->fetchObject('App\Pet');

            return $row;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new Exception('Something went wrong');
        }
    }

    public static function register($name, $breed, $birthdate, $ownerName, $gender, $address, $email, $contactNumber)
    {
        global $conn;

        try {
            $sql = "
                INSERT INTO pets (name, breed, birthdate, owner_name, gender, address, email, contact_number)
                VALUES (:name, :breed, :birthdate, :ownerName, :gender, :address, :email, :contactNumber)
            ";
            $statement = $conn->prepare($sql);
            $statement->execute([
                'name' => $name,
                'breed' => $breed,
                'birthdate' => $birthdate,
                'ownerName' => $ownerName,
                'gender' => $gender,
                'address' => $address,
                'email' => $email,
                'contactNumber' => $contactNumber,
            ]);

            return $conn->lastInsertId();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function save()
    {
        global $conn;

        try {
            if ($this->id) {
                $sql = "
                    UPDATE pets
                    SET
                        name = :name,
                        breed = :breed,
                        birthdate = :birthdate,
                        owner_name = :ownerName,
                        contact_number = :contact_number,
                        gender = :gender,
                        address = :address,
                        email = :email
                    WHERE id = :id
                ";
                $statement = $conn->prepare($sql);
                $result = $statement->execute([
                    'id' => $this->id,
                    'name' => $this->name,
                    'breed' => $this->breed,
                    'birthdate' => $this->birthdate,
                    'ownerName' => $this->ownerName,
                    'contact_number' => $this->contact_number,
                    'gender' => $this->gender,
                    'address' => $this->address,
                    'email' => $this->email,
                ]);
    
                return $result;
            } else {
                $sql = "
                    INSERT INTO pets (name, breed, birthdate, owner_name, contact_number, gender, address, email, created_at)
                    VALUES (:name, :breed, :birthdate, :ownerName, :contact_number, :gender, :address, :email, :createdAt)
                ";
                $statement = $conn->prepare($sql);
                $result = $statement->execute([
                    'name' => $this->name,
                    'breed' => $this->breed,
                    'birthdate' => $this->birthdate,
                    'ownerName' => $this->ownerName,
                    'contact_number' => $this->contact_number,
                    'gender' => $this->gender,
                    'address' => $this->address,
                    'email' => $this->email,
                ]);
    
                $this->id = $conn->lastInsertId();
    
                return $result;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    public static function update($id, $name, $breed, $birthdate, $ownerName, $gender, $address, $email, $contact_number) {
        global $conn;
        
        try {
            $sql = "
                    UPDATE pets
                    SET
                            name=?,
                            breed=?,
                            birthdate=?,
                            ownerName=?,
                            gender=?,
                            address=?,
                            email=?,
                            contact_number=?
                    WHERE id=?
            ";
            $statement = $conn->prepare($sql);
            return $statement->execute([
                $name, 
                $breed, 
                $birthdate, 
                $ownerName, 
                $gender, 
                $address, 
                $email, 
                $contact_number,
                $id,
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    public static function updateUsingPlaceholder($id, $name, $breed, $birthdate, $ownerName, $gender, $address, $email, $contact_number)
	{
		global $conn;

		try {
			$sql = "
				UPDATE pets
				SET
                name=:name
                breed=:breed,
                birthdate=:birthdate,
                ownerName=:ownerName,
                gender=:gender,
                address=:address,
                email=:email,
                contact_number=:contact_number
				WHERE id=:id
			";
			$statement = $conn->prepare($sql);
			return $statement->execute([
				'name' => $name,
				'breed' => $breed,
                'birthdate' => $birthdate,
                'ownerName' => $ownerName,
                'gender' => $gender,
                'address' => $address,
				'email' => $email,
                'contact_number' => $contact_number,
				'id' => $id
			]);
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

    public static function deleteById($id)
	{
		global $conn;

		try {
			$sql = "
				DELETE FROM pets
				WHERE id=:id
			";
			$statement = $conn->prepare($sql);
			return $statement->execute([
				'id' => $id
			]);
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function clearTable()
	{
		global $conn;

		try {
			$sql = "TRUNCATE TABLE pets";
			$statement = $conn->prepare($sql);
			return $statement->execute();
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}
}
        
