<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Hashing\BcryptHasher;
use App\User;
use App\Payment;

class PaymentTest extends TestCase
{
  /**
   * Fail creating new Payment Model.
   *
   * @return void
   */
  public function testFailCreateModel()
  {
    $this->assertEquals(
      422, 
      $this->call('POST', 'payment/prepare')->status()
    );
    $this->assertEquals(
      422, 
      $this->call('POST', 'payment/prepare', [
        'amount' => '100+100',
        'type' => 'ABC'
      ])->status()
    );
    $this->assertEquals(
      422, 
      $this->call('POST', 'payment/prepare', [
        'amount' => '10 100.00',
        'type' => ''
      ])->status()
    );
  }

  /**
   * Succeed creating new Payment Model.
   *
   * @return void
   */
  public function testCreateModel()
  {
    $response = $this->call('POST', 'payment/prepare', [
      'amount' => '999.00',
      'type' => 'DF'
    ]);

    $this->assertEquals(
      200, 
      $response->status()
    );
  }
}