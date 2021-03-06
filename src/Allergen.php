<?php

    class FoodAllergy
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        //Getters and Setters
        function getName()
        {
            return $this->name;

        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getId()
        {
            return $this->id;
        }

        //Database methods

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO Food_Allergy (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_allergies = $GLOBALS['DB']->query("SELECT * FROM Food_Allergy;");
            //lower table name only
            $allergies = array();
            foreach($returned_allergies as $allergy){
                $name = $allergy['name'];
                $id = $allergy['id'];
                $new_allergy = new FoodAllergy($name, $id);
                array_push($allergies, $new_allergy);
            }
            return $allergies;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM Food_Allergy;");
        }




    }



 ?>
