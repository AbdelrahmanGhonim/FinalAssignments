<?php
namespace App\Models;

class NutritionFact implements \JsonSerializable{

private $userId;
  private $foodName;
  private $carbs;
  private $proteins;
  private $fats;
  private $fibers;


  public function __construct($userId,$foodName, $carbs, $proteins, $fats, $fibers) {
    $this->userId = $userId;
    $this->foodName = $foodName;
    $this->carbs = $carbs;
    $this->proteins = $proteins;
    $this->fats = $fats;
    $this->fibers = $fibers;
  }


  public function getUserId()
  {
      return $this->userId;
  }
  public function setUserId($userId)
  {
      $this->userId = $userId;
  }
  public function getFoodName() {
    return $this->foodName;
  }
  public function getCarbs() {
    return $this->carbs;
  }
  public function getProteins() {
    return $this->proteins;
  }
  public function getFats() {
    return $this->fats;
  }
  public function getFibers() {
    return $this->fibers;
  }
  public function setFoodName($foodName) {
    $this->foodName = $foodName;
  }
  public function setCarbs($carbs) {
    $this->carbs = $carbs;
  }
  public function setProteins($proteins) {
    $this->proteins = $proteins;
  }
  public function setFats($fats) {
    $this->fats = $fats;
  }
  public function setFibers($fibers) {
    $this->fibers = $fibers;
  }

  public function jsonSerialize():mixed {
    $vars=get_object_vars($this);
    return $vars;
  }

}