<?php 
class CustomerkeysController extends AppController {
	var $helpers = array('App');
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
		$this->layout = 'admin';
    }
	




	private function getGroupedProducts() {
		$this->Customerkey->recursive = 0;
		
		$solutions = $this->Customerkey->Solution->find('all',array('order'=>'product,name'));
		$group = array();
		foreach ($solutions as $solution) {
			$groupName = $solution['Solution']['product'];
			$value = $solution['Solution']['id'];
			$name = $solution['Solution']['name'];
			$group[$groupName][$value] = $name;
			
		}
		return $group;
	}	

	public function validatekey() {
		$this->layout = "ajax";
		if ($this->RequestHandler->isAjax()) {
			$this->request->data['Customerkey']['accesskey'] = $this->data['accesskey'];
			$this->request->data['Customerkey']['id'] = $this->data['customerkey_id'];			

			$this->Customerkey->set($this->request->data);
			if ($this->Customerkey->validates()) {
				$this->autoRender = FALSE;
			} else {
				$errors = $this->validateErrors($this->Customerkey);
				$this->response->type('text/json');
				$this->set('error',$errors['accesskey']);
			}
		}

	}


    public function index() {
        
		$keys = $this->Customerkey->find('all');
	//	$this->layout = 'viewlayout';
        $this->set('customerkeys', $keys);
		 //$this->set('customerkeys', "");
    }

   
   
   
    public function add() {
 //    	$this->layout = 'viewlayout';
		$this->set('customerkey_id','');
		
 
		$this->set('groupProducts',$this->getGroupedProducts());		
		
        if ($this->request->is('post')) {
        	$customerkey = $this->request->data;

            $this->Customerkey->create();
            if ($this->Customerkey->save($this->request->data)) {
                $this->Session->setFlash(__('The Access Key has been saved'));
                $this->redirect(array('action' => 'index'));
                
            } else {
                $this->Session->setFlash(__('The customer could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
    	//$this->layout = 'viewlayout';
		$this->set('groupProducts',$this->getGroupedProducts());		
		$this->Customerkey->recursive = 1;
        $this->Customerkey->id = $id;
		$this->set('customerkey_id',$id);	
		

        if (!$this->Customerkey->exists()) {
            throw new NotFoundException(__('Invalid Customerkey'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
  
			$this->Customerkey->set($this->request->data);
			
            if ($this->Customerkey->validates()) {
            	var_dump($this->request->data['submitaction']);
            	if ($this->request->data['submitaction'] == 'Expire Now') {
        			$dat =  date("Y-m-d", time() - (60*60*48));
					$this->request->data['Customerkey']['expires']= $dat;
        	
        		}
				$this->Customerkey->save($this->request->data);
				
                $this->Session->setFlash(__('The customer key has been updated.'));
       
               $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The customer could not be saved. Please, try again.'));
            }
        } else {
        	
            $this->request->data = $this->Customerkey->read(null, $id);
			$ddate = strtotime($this->request->data['Customerkey']['expires']);
			$formattedDate = date('Y-m-d',$ddate);
			$this->request->data['Customerkey']['expires'] = $formattedDate;		
			
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Customerkey->id = $id;
        if (!$this->Customerkey->exists()) {
            throw new NotFoundException(__('Invalid Customerkey'));
        }
        if ($this->Customerkey->delete()) {
            $this->Session->setFlash(__('Customerkey deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Customerkey was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}