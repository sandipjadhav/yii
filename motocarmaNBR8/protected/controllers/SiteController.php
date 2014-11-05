<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionUserHome() {
        $guestStyleExists = Yii::app()->user->hasState("guest_style") ;
        $arrCarInfo = $this->getCarDetailsForPreviewPage();
        $roles = Rights::getAssignedRoles(Yii::app()->user->Id);
        if (count($roles) === 1) { 
            $view = $this->getViewForRole(current($roles));
            if ($view !== '') { 
                    if(isset($_GET['message']) && $_GET['message'] !=''){
                        $this->render($view . '_index', array('arrCarInfo'=>$arrCarInfo,'guestStyleExists'=>$guestStyleExists,'message'=>$_GET['message']));
                    }else{
                    $this->render($view . '_index', array('arrCarInfo'=>$arrCarInfo,'guestStyleExists'=>$guestStyleExists));
                    }
            } else {
                $this->render('index');
            }
        } else {
            $this->render('index');
        }
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() { 
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $roles = Rights::getAssignedRoles(Yii::app()->user->Id);
        if (count($roles) === 1) { 
            $view = $this->getViewForRole(current($roles));
            if ($view !== '') { 
                if(current($roles)->name == 'Authenticated'){
                    $this->render('index');
                    //$this->render($view . '_index');
                }else{
                    $this->render($view . '_index');
                }
            } else {
                $this->render('index');
            }
        } else {
            $this->render('index');
        }
        //unset(Yii::app()->session['guest_style']);
    }

    // TODO SK: This won't work if there are multiple roles.
    protected function getViewForRole($role) {
        $view = ""; 
        // $roles = Yii::app()->user->getState('roles'); //however you define your role, have the value output to this variable
        switch ($role->name) {
            case "admin":
                $view = "admin";
                break;
            case "dealer":
                $view = "dealer";
                break;
            case "salesperson":
                $view = "salesperson";
                break;
            case "Authenticated":
                $view = "user";
                break;
            case "user":
                $view = "user";
                break;
        }
        return $view;
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        Yii::beginProfile('application.controllers.SiteController.actionLogin');
        Yii::trace('Executing actionLogin() method', 'application.controllers.SiteController');
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                Yii::log('Successful login of user: ' . Yii::app()->user->id, Clogger::LEVEL_INFO, 'application.controllers.SiteController');
                if (Yii::app()->user->getState('role') == 'admin') {
                    $this->redirect('user/profile2');
                } else {
                    $this->redirect(Yii::app()->user->returnUrl);
                }
            } else {
                Yii::log('Failed login attempt of user: ' . Yii::app()->user->id, Clogger::LEVEL_WARNING, 'application.controllers.SiteController');
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
        Yii::endProfile('application.controllers.SiteController.actionLogin');
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
    
    private function getCarDetailsForPreviewPage(){
            $carInfo = array();
            if(Yii::app()->user->getState("guest_style")!=''){
                //unset(Yii::app()->session['userid']);
                
                $jsonStyle = Yii::app()->user->getState("guest_style");

                $objStyle = json_decode($jsonStyle);
                $carInfo['Make'] = $objStyle->make->name;
                $carInfo['Model'] = $objStyle->model->name;
                $carInfo['Year'] = $objStyle->year->year;
                $carInfo['Price'] = $objStyle->price->baseMSRP;
                $carInfo['StyleID'] = $objStyle->id;
            }else{
                $userId = Yii::app()->user->Id;
                $car =  Car::model()
                        ->with(
                                array(
                                    'savedCars'=>array('joinType'=>'INNER JOIN',
                                                      'condition'=> 'savedCars.User_ID ='. $userId,
                                                      'order'=>'savedCars.ID DESC',
                                                      'limit'=>'1'),
                                    'deals'=> array('joinType'=>'INNER JOIN')
                                    )
                                )
                        ->find();
                
                $carInfo['Make'] = $car['Make'];
                $carInfo['Model'] = $car['Model'];
                $carInfo['Year'] = $car['Year'];
                $carInfo['Price'] = $car['Price'];
                $carInfo['StyleID'] = $car['StyleID'];
                
         
            }
            
            return $carInfo;
        }

}
