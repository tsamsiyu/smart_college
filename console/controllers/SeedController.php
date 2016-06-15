<?php namespace console\controllers;

use common\components\helpers\ArrayHelper;
use common\models\college\College;
use common\models\college\Direction;
use common\models\college\Group;
use common\models\college\GroupNews;
use common\models\college\Pulpit;
use common\models\college\PulpitNews;
use common\models\college\Subject;
use common\models\Message;
use common\models\user\Profile;
use common\models\user\User;
use Faker\Factory;
use frontend\models\auth\SignupStudentForm;
use frontend\models\auth\SignupTeacherForm;
use yii\console\Controller;

class SeedController extends Controller
{
    public function actionFill()
    {
        $dgma = require(\Yii::getAlias('@console/controllers/seeds/dgma.php'));
        $directions = ArrayHelper::remove($dgma, 'college_direction');
        $faker = Factory::create();

        Message::deleteAll();
        GroupNews::deleteAll();
        PulpitNews::deleteAll();
        Group::deleteAll();
        Subject::deleteAll();
        Pulpit::deleteAll();
        Direction::deleteAll();
        College::deleteAll();
        Profile::deleteAll();
        User::deleteAll();


        $college = new College();
        $college->setAttributes($dgma, false);
        $collegeUsersIds = [];
        $startTimestamp = microtime(true);

        if ($college->save()) {
            if (is_array($directions)) {
                foreach ($directions as $direction) {
                    $directionModel = new Direction();
                    $pulpits = ArrayHelper::remove($direction, 'college_pulpit');
                    $directionModel->setAttributes($direction, false);
                    $directionModel->college_id = $college->id;
                    if ($directionModel->save()) {
                        if (is_array($pulpits)) {
                            foreach ($pulpits as $pulpit) {
                                $pulpitModel = new Pulpit();
                                $pulpitModel->direction_id = $directionModel->id;
                                $pulpitModel->setAttributes($pulpit, false);
                                $subjects = ArrayHelper::remove($pulpit, 'subjects');
                                if ($pulpitModel->save()) {
                                    $teachersIds = [];
                                    for ($i = 1; $i <= mt_rand(6, 12); ++$i) {
                                        $user = new SignupTeacherForm();
                                        $user->email = $faker->freeEmail;
                                        $user->role = User::TEACHER;
                                        $user->college_id = $college->id;
                                        $user->pulpit_id = $pulpitModel->id;
                                        $user->first_name = $faker->firstName;
                                        $user->last_name = $faker->lastName;
                                        $user->password = '123123';
                                        $user->password_repeat = '123123';
                                        if ($savedMode = $user->signup()) {
                                            $collegeUsersIds[] = $savedMode->id;
                                            $teachersIds[] = $savedMode->id;
                                        }
                                    }

                                    for ($i = 0; $i <= mt_rand(0, 20); ++$i) {
                                        $topic = new PulpitNews();
                                        $topic->pulpit_id = $pulpitModel->id;
                                        $topic->access = mt_rand(0, 1) ? PulpitNews::PUBLIC_ACCESS : PulpitNews::PRIVATE_ACCESS;
                                        $topic->body = $faker->text(400);
                                        $topic->author_id = $teachersIds[mt_rand(0, count($teachersIds) - 1)];
                                        $topic->created_at = date('Y-m-d', mt_rand(strtotime('-10 years'), time()));
                                        if (!$topic->save()) {
                                            var_dump($topic->getErrors());
                                        }
                                    }

                                    for ($i = 0; $i < mt_rand(5, 15); ++$i) {
                                        for ($j = 1; $j <= mt_rand(1, 3); ++$j) {
                                            $groupModel = new Group();
                                            $groupModel->pulpit_id = $pulpitModel->id;
                                            $groupModel->code = $pulpitModel->code . ' ' . $i . '-' . $j;
                                            $groupModel->course = $i - (5 * (int)($i / 5)) + 1;
                                            if ($groupModel->save()) {
                                                $studentsIds = [];
                                                for ($i = 1; $i <= mt_rand(9, 35); ++$i) {
                                                    $user = new SignupStudentForm();
                                                    $user->email = $faker->freeEmail;
                                                    $user->role = User::STUDENT;
                                                    $user->college_id = $college->id;
                                                    $user->group_id = $groupModel->id;
                                                    $user->pulpit_id = $pulpitModel->id;
                                                    $user->first_name = $faker->firstName;
                                                    $user->last_name = $faker->lastName;
                                                    $user->password = '123123';
                                                    $user->password_repeat = '123123';
                                                    if ($savedModel = $user->signup()) {
                                                        $collegeUsersIds[] = $savedModel->id;
                                                        $studentsIds[] = $savedModel->id;
                                                    } else {
                                                        var_dump($user->getErrors());
                                                    }
                                                }

                                                for ($i = 0; $i <= mt_rand(0, 20); ++$i) {
                                                    $topic = new GroupNews();
                                                    $topic->group_id = $groupModel->id;
                                                    $topic->access = mt_rand(0, 1) ? GroupNews::PUBLIC_ACCESS : GroupNews::PRIVATE_ACCESS;
                                                    $topic->body = $faker->text(400);
                                                    $topic->author_id = $studentsIds[mt_rand(0, count($studentsIds) - 1)];
                                                    $topic->created_at = mt_rand(strtotime('-10 years'), time());
                                                    $topic->updated_at = $topic->created_at;
                                                    if (!$topic->save()) {
                                                        var_dump($topic->getErrors());
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    if (is_array($subjects)) {
                                        foreach ($subjects as $subject) {
                                            $subjectModel = new Subject();
                                            $subjectModel->pulpit_id = $pulpitModel->id;
                                            $subjectModel->setAttributes($subject, false);
                                            $subjectModel->save();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            for ($i = 1; $i <= 7; ++$i) {
                foreach ($collegeUsersIds as $userId) {
                    if (mt_rand(0, 1)) {
                        $msg = new Message();
                        $msg->text = $faker->text();
                        $msg->id_sender = $userId;
                        $msg->id_recipient = $collegeUsersIds[mt_rand(0, count($collegeUsersIds) - 1)];
                        if (!$msg->save()) {
                            var_dump($msg->getErrors());
                        }
                    }
                }
            }
        }

        echo (microtime(true) - $startTimestamp) . "\n";
    }

    public function actionGenerate()
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 10; ++$i) {
            $college = new College();
            $college->name = $faker->words(mt_rand(2, 6), true);
            $college->code = $this->splitAbbr($college->name);
            $college->year_parts = mt_rand(2, 3);
            $college->courses_count = mt_rand(4, 5);
            $collegeUsersIds = [];
            if ($college->save()) {
                for ($i = 1; $i <= mt_rand(2, 8); ++$i) {
                    $direction = new Direction();
                    $direction->name = $faker->words(mt_rand(2, 6), true);
                    $direction->code = $this->splitAbbr($direction->name);
                    $direction->college_id = $college->id;
                    if ($direction->save()) {
                        for ($i = 1; $i <= mt_rand(1, 6); ++$i) {
                            $pulpit = new Pulpit();
                            $pulpit->name = $faker->words(mt_rand(2, 6), true);
                            $pulpit->code = $this->splitAbbr($pulpit->name);
                            $pulpit->status = 10;
                            if ($pulpit->save()) {
                                $teachersIds = [];
                                for ($i = 1; $i <= mt_rand(6, 12); ++$i) {
                                    $user = new SignupTeacherForm();
                                    $user->email = $faker->freeEmail;
                                    $user->role = User::TEACHER;
                                    $user->college_id = $college->id;
                                    $user->pulpit_id = $pulpit->id;
                                    $user->first_name = $faker->firstName;
                                    $user->last_name = $faker->lastName;
                                    $user->password = '123123';
                                    $user->password_repeat = '123123';
                                    if ($savedModel = $user->signup()) {
                                        $teachersIds[] = $savedModel->id;
                                        $collegeUsersIds[] = $savedModel->id;
                                    }
                                }

                                for ($i = 0; $i <= mt_rand(0, 20); ++$i) {
                                    $topic = new PulpitNews();
                                    $topic->pulpit_id = $pulpit->id;
                                    $topic->access = mt_rand(0, 1) ? PulpitNews::PUBLIC_ACCESS : PulpitNews::PRIVATE_ACCESS;
                                    $topic->body = $faker->text(400);
                                    $topic->author_id = $teachersIds[mt_rand(0, count($teachersIds) - 1)];
                                    if (!$topic->save()) {
                                        var_dump($topic->getErrors());
                                    }
                                }

                                for ($i = 1; $i <= mt_rand(4, 20); ++$i) {
                                    $subject = new Subject();
                                    $subject->name = $faker->words(mt_rand(1, 4), true);
                                    $subject->code = $this->splitAbbr($subject->name);
                                    $subject->description = $faker->sentence(mt_rand(6, 40));
                                    $subject->pulpit_id = $pulpit->id;
                                    $subject->save();
                                }

                                for ($i = 0; $i < mt_rand(5, 15); ++$i) {
                                    for ($j = 1; $j <= mt_rand(1, 3); ++$j) {
                                        $groupModel = new Group();
                                        $groupModel->pulpit_id = $pulpit->id;
                                        $groupModel->code = $pulpit->code . ' ' . $i . '-' . $j;
                                        $groupModel->course = $i - (5 * (int)($i / 5)) + 1;
                                        if ($groupModel->save()) {
                                            $studentsIds = [];
                                            for ($i = 1; $i <= mt_rand(9, 30); ++$i) {
                                                $user = new SignupStudentForm();
                                                $user->email = $faker->freeEmail;
                                                $user->role = User::STUDENT;
                                                $user->college_id = $college->id;
                                                $user->group_id = $groupModel->id;
                                                $user->first_name = $faker->firstName;
                                                $user->last_name = $faker->lastName;
                                                $user->password = '123123';
                                                $user->password_repeat = '123123';
                                                if ($savedModel = $user->signup()) {
                                                    $studentsIds[] = $savedModel->id;
                                                    $collegeUsersIds[] = $savedModel->id;
                                                }
                                            }

                                            for ($i = 0; $i <= mt_rand(0, 20); ++$i) {
                                                $topic = new GroupNews();
                                                $topic->group_id = $groupModel->id;
                                                $topic->access = mt_rand(0, 1) ? GroupNews::PUBLIC_ACCESS : GroupNews::PRIVATE_ACCESS;
                                                $topic->body = $faker->text(400);
                                                $topic->author_id = $studentsIds[mt_rand(0, count($studentsIds) - 1)];
                                                if (!$topic->save()) {
                                                    var_dump($topic->getErrors());
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                for ($i = 1; $i <= 5; ++$i) {
                    foreach ($collegeUsersIds as $userId) {
                        if (mt_rand(0, 1)) {
                            $msg = new Message();
                            $msg->text = $faker->text();
                            $msg->id_sender = $userId;
                            $msg->id_recipient = $collegeUsersIds[mt_rand(0, count($collegeUsersIds) - 1)];
                            $msg->save();
                        }
                    }
                }
            }
        }
    }

    private function splitAbbr($text)
    {
        $arr = explode(' ', $text);
        if (count($arr) == 1) {
            return ucfirst($text);
        }
        $res = '';
        foreach ($arr as $item) {
            $res .= strlen($item) > 1 ? ucfirst($item[0]) : $item;
        }

        return $res;
    }

    public function actionTest()
    {
        var_dump(strtotime('-10 years'));

        die;
        $faker = Factory::create();
        $w = $faker->words(3, true);
        var_dump($w);
        var_dump($this->splitAbbr($w));
    }

    public function actionMessageCreated()
    {
        $msgs = Message::find()->all();

        foreach ($msgs as $item) {
            $item->created_at = mt_rand(strtotime('-10 years'), time());
            $item->updated_at = $item->created_at;
            $item->update(false, ['created_at', 'updated_at']);
        }
    }

    public function actionGroupNewsCreated()
    {
        $msgs = GroupNews::find()->all();

        foreach ($msgs as $item) {
            $item->created_at = mt_rand(strtotime('-10 years'), time());
            $item->updated_at = $item->created_at;
            $item->update(false, ['created_at', 'updated_at']);
        }
    }

    public function actionPulpitNewsCreated()
    {
        $msgs = PulpitNews::find()->all();

        foreach ($msgs as $item) {
            $item->created_at = mt_rand(strtotime('-10 years'), time());
            $item->updated_at = $item->created_at;
            $item->update(false, ['created_at', 'updated_at']);
        }
    }
}