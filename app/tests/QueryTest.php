<?php

class ModelTest extends TestCase

{
	public function test_add_new () {

		$response = $this->action('POST', 'TasksController@post_add_new', array('task_name' => 'new task'));

		var_dump($response ->getContent());
	}

	public function test_login () {
        
        $crawler = $this->client->request('GET', '/');
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertResponseOk();

        $form = $crawler->selectButton("Login")->form();
        $this->assertNotNull($form, "Form is not here");

        $form->setValues(array(
            "username" => "demo",
            "password" => "demo",
        ));
        
        $this->client->submit($form);
        $this->assertRedirectedTo("/tasks");

    } 

    public function test_tasks () {

        $response = $this->client->request('POST', '/add_new');

        $this->assertTrue($this->client->getResponse()->isOk());      
    }
}