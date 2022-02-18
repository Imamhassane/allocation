<?php 
namespace App\Core;
class Application{

    private Rooter $rooter;
    public function run(){
        $this->rooter=new Rooter(new Request)  ; 
        $this->rooter->resolve();
    }

}