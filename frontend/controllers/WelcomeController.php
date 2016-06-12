<?php namespace frontend\controllers;

use common\models\user\LoginForm;
use common\models\user\User;
use frontend\models\auth\SignupForm;
use frontend\models\auth\SignupStudentForm;
use frontend\models\auth\SignupTeacherForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class WelcomeController extends Controller
{
    const REGISTER_STEP1 = 'register_step_1';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?']
                    ]
                ],
                'denyCallback' => function () {
                    /* @var \frontend\components\web\User $user */
                    $user = Yii::$app->user;
                    return $this->redirect([$user->homeUrl]);
                }
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get', 'post'],
                    'register' => ['get', 'post'],
                    'register-student' => ['get', 'post'],
                    'register-teacher' => ['get', 'post'],
                    'register-owner' => ['get', 'post']
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $model = new LoginForm();

        if (isset($_POST['LoginForm'])) {
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->redirect([Yii::$app->user->homeUrl]);
            }
        }

        return $this->render('login', [
            'form' => $model
        ]);
    }

    /**
     * Этот метод принимает данные, посланные клиентом
     * на первом шаге регистрации. Если они валидны -
     * происоходит перенаправление на второй шаг регистрации.
     *
     * @return bool|string|\yii\web\Response
     */
    public function actionRegister()
    {
        $model = new SignupForm();
        $app = Yii::$app;

        if ($app->session->has(self::REGISTER_STEP1)) {
            $model->setAttributes($app->session->get(self::REGISTER_STEP1));
            $app->session->remove(self::REGISTER_STEP1);
        }

        if (isset($_POST['SignupForm'])) {
            if ($model->load($app->request->post()) && $model->validate()) {
                $app->session->set(self::REGISTER_STEP1, $_POST['SignupForm']);
                return $this->redirectToStep2($model);
            }
        }

        return $this->render('register', [
            'form' => $model
        ]);
    }

    /**
     * Этот метод принимает данные с формы второго шага
     * регистрации пользователя. Если данные валидны, то он
     * сохраняет пользователя в базу данных, выставляя ему роль "Студент"
     *
     * NOTE:    перед валидацией данных, метод проверяет, что в сессии
     *          хрянятся данные с первого шага, если их там нет -
     *          пользователь будет перенаправлен на него.
     *
     * @return string|\yii\web\Response
     */
    public function actionRegisterStudent()
    {
        $model = new SignupStudentForm();

        if (!$this->checkFirstStep($model)) {
            Yii::$app->session->remove(self::REGISTER_STEP1);
            return $this->redirect(['welcome/register']);
        }

        if (isset($_POST['SignupStudentForm'])) {
            if ($model->load(Yii::$app->request->post()) && ($user = $model->signup())) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect([Yii::$app->user->homeUrl]);
                }
            }
        }
        return $this->render('register_student', [
            'form' => $model
        ]);
    }

    /**
     * Этот метод принимает данные с формы второго шага
     * регистрации пользователя. Если данные валидны, то он
     * сохраняет пользователя в базу данных, выставляя ему роль "Преподаватель"
     *
     * NOTE:    перед валидацией данных, метод проверяет, что в сессии
     *          хрянятся данные с первого шага, если их там нет -
     *          пользователь будет перенаправлен на него.
     *
     * @return string|\yii\web\Response
     */
    public function actionRegisterTeacher()
    {
        $model = new SignupTeacherForm();

        if (!$this->checkFirstStep($model)) {
            Yii::$app->session->remove(self::REGISTER_STEP1);
            return $this->redirect(['welcome/register']);
        }

        if (isset($_POST['SignupTeacherForm'])) {
            if ($model->load(Yii::$app->request->post()) && ($user = $model->signup())) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect([Yii::$app->user->homeUrl]);
                }
            }
        }

        return $this->render('register_teacher', [
            'form' => $model
        ]);
    }

    /**
     * В зависимости от роли пользователя определяет url
     * для второго шага регистрации и перенаправляет туда
     *
     * @param SignupForm $model
     * @return bool|\yii\web\Response
     */
    public function redirectToStep2(SignupForm $model)
    {
        switch ($model->role) {
            case User::COLLEGE_OWNER:
                $route = 'welcome/register-owner'; break;
            case User::STUDENT:
                $route = 'welcome/register-student'; break;
            case User::TEACHER:
                $route = 'welcome/register-teacher'; break;
            default:
                return false;
        }

        return $this->redirect([$route]);
    }

    /**
     * Если в сессии есть данные с первого шага регистрации -
     * возвращает результат их валидации, иначе - возвращает false
     *
     * @param SignupForm $model
     * @return bool
     */
    protected function checkFirstStep(SignupForm $model)
    {
        $primaryData = Yii::$app->session->get(self::REGISTER_STEP1);

        if ($primaryData) {
            $model->setAttributes($primaryData);
            return $model->validate(['email', 'password', 'password_repeat', 'role']);
        }

        return false;
    }

}