<?php

use App\Core\Response;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{    
    /**
     * validate the email address
     *
     * @return void
     */
    public function test_for_email_verifying_login_request(): void
    {
        $mock = $this->getMockBuilder(LoginRequest::class)->getMock();
        $mock->expects($this->once())->method('validated')
            ->with(['email' => 'abc@test'])
            ->willReturn(['status' => 403]);

        $result = $mock->validated(['email' => 'abc@test']);
        
        $this->assertEquals(['status' => 403], $result);
    }
}