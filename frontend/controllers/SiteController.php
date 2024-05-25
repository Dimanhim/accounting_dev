<?php

namespace frontend\controllers;

use common\models\BordOffer;
use common\models\BordProduct;
use common\models\Portfolio;
use common\models\LandingTariff;
use frontend\components\Site;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\SiteForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $site = new Site();
        $this->view->title = $site->title;
        $model = new SiteForm();



        return $this->render('index', [
            'site' => $site,
            'model' => $model,
        ]);
    }

    public function actionBordShop()
    {
        $count = 0;

        \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('Content-Type', 'text/xml');

        $file = simplexml_load_file('bordshop/xml.xml');

        /*if($file and $file->shop and ($categories = $file->shop->categories)) {
            $categories = $categories->category;
            echo "<pre>";
            print_r($categories);
            echo "</pre>";
            exit;
            foreach($categories as $categorYObj) {

                foreach($categorYObj as $categorItem) {
                    $id = $offerItem->attributes()->id;
                    $available = $offerItem->attributes()->available;
                    $param = $offerItem->param;


                }
            }
        }*/

        if($file and $file->shop and ($offers = $file->shop->offers)) {
            foreach($offers as $offerObj) {
                foreach($offerObj as $offerItem) {
                    $id = (string) $offerItem->attributes()->id;
                    $available = $offerItem->attributes()->available;
                    $param = $offerItem->param;

                    $model = new BordProduct();
                    $model->offer_id = $id;
                    $model->avaliable = (string) $available;
                    $model->name = (string) trim($offerItem->name);
                    $model->categoryId = (string) $offerItem->categoryId;
                    $model->picture = (string) trim($offerItem->picture);
                    $model->price = (string) $offerItem->price;
                    $model->currencyId = (string) $offerItem->currencyId;
                    $model->oldprice = (string) $offerItem->oldprice;
                    $model->url = (string) str_replace('skusku', 'sku', trim($offerItem->url));
                    $model->vendor = (string) trim($offerItem->vendor);
                    $model->description = (string) trim($offerItem->description);
                    $model->vendorCode = '97094';
                    $model->setBarcode();
                    $model->setModel();
                    if($param and isset($param[0]) and isset($param[1]) and isset($param[2])) {
                        $model->_chars = [
                            'Цвет' => (string) $param[0],
                            'Пол' => (string) $param[1],
                            'Размер' => (string) $param[2],
                        ];
                    }
                    if($model->save()) {
                        $count++;
                    }
                    else {
                        echo "<pre>";
                        print_r($model->errors);
                        echo "</pre>";
                        exit;
                    }
                }
            }
        }

        return 'Добавлено '.$count.' товаров';

        return $this->renderPartial('bordshop/xml', [
            'file' => $file
        ]);
    }

    public function actionBordShopFormat()
    {
        $count = 0;

        $pattern = "/размер.*/ui";

        $products = BordProduct::find()->all();

        $productNames = [];

        if($products) {
            foreach($products as $product) {
                preg_match_all($pattern, $product->name, $matches);
                $matches = $matches[0];
                if($matches and isset($matches[0])) {
                    $matches = $matches[0];
                    $size = str_replace('размер', '', $matches);
                    $size = trim($size);
                    $productName = str_replace($matches, '', $product->name);
                    $productName = trim($productName);
                    $productName = mb_substr($productName, 0, -1);
                    if(!in_array($productName, $productNames)) {
                        $productNames[] = $productName;
                        $product->name = $productName;
                        $product->_chars['Размер'] = $size;
                        $model = new BordOffer();
                    }
                    else {
                        $chars = $product->_chars;
                        $chars['Размер'] = $size;
                        $product->_chars[] = $chars;
                        $model = BordOffer::findOne(['name' => $productName]);

                    }
                }
                else {
                    $model = new BordOffer();
                }

                if($model) {
                    $model->attributes = $product->attributes;
                    $model->product_id = $product->id;
                    $model->_chars = $product->_chars;
                    if($model->save()) {
                        $count++;
                    }
                    else {
                        echo "<pre>";
                        print_r($model->errors);
                        echo "</pre>";
                        exit;
                    }
                }
            }
        }
        return 'Добавлено '.$count.' продуктов';
    }

    public function actionPortfolio()
    {
        $this->layout = 'portfolio';
        $this->view->title = 'Портфолио '.Yii::$app->name;
        $portfolio = Portfolio::finyesdModels()->all();
        return $this->render('portfolio', [
            'portfolio' => $portfolio,
        ]);
    }

    public function actionFormValidate()
    {
        $response = [
            'result' => 0,
            'message' => null,
        ];

        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax) {
            $model = new SiteForm();
            if($model->load(Yii::$app->request->post())) {
                if(!$model->validate()) {
                    $response['message'] = $model->firstError();
                }
                else {
                    $response['result'] = 1;
                }
            }
        }
        return $response;
    }

    public function actionSendForm()
    {
        $response = [
            'result' => 0,
        ];

        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax) {
            $model = new SiteForm();
            if($model->load(Yii::$app->request->post()) and $model->validate() and $model->saveData()) {
                if ($model->sendAdminEmail()) {
                    $response['result'] = 1;
                }
            }
        }
        return $response;
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
