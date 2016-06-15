<?php

namespace frontend\controllers;

use common\components\web\Controller;
use common\models\college\College;
use common\models\college\GroupNews;
use common\models\college\PulpitNews;
use yii\db\Expression;
use yii\db\Query;

class CollegesController extends Controller
{
    public function actionIndex()
    {
        $colleges = College::find()->all();

        return $this->render('index', [
            'colleges' => $colleges
        ]);
    }

    public function actionStatisticMenu($id)
    {
        return $this->render('statistic-list', [
            'id' => $id
        ]);
    }

    public function actionGroupPublicNews($id)
    {
        $messagesByPulpits = (new Query)
            ->addSelect(['total' => new Expression('COUNT(n.id)')])
            ->addSelect('p.name')
            ->from(['n' => 'college_group_news'])
            ->andWhere(['n.access' => GroupNews::PUBLIC_ACCESS])
            ->innerJoin('college_group g', 'g.id = n.group_id')
            ->innerJoin('college_pulpit p', 'p.id = g.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy('p.id')
            ->all();

        $messagesByDirections = (new Query)
            ->addSelect(['total' => new Expression('COUNT(n.id)')])
            ->addSelect('d.name')
            ->from(['n' => 'college_group_news'])
            ->andWhere(['n.access' => GroupNews::PUBLIC_ACCESS])
            ->innerJoin('college_group g', 'g.id = n.group_id')
            ->innerJoin('college_pulpit p', 'p.id = g.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy('d.id')
            ->all();

        $messagesByPulpitsDataTbl = [];
        foreach ($messagesByPulpits as $item) {
            $messagesByPulpitsDataTbl[] = [$item['name'], (int)$item['total']];
        }

        $messagesByDirectionsDataTbl = [];
        foreach ($messagesByDirections as $item) {
            $messagesByDirectionsDataTbl[] = [$item['name'], (int)$item['total']];
        }

        return $this->render('groupPublicNews', [
            'messagesByPulpit' => $messagesByPulpitsDataTbl,
            'messagesByDirection' => $messagesByDirectionsDataTbl
        ]);
    }

    public function actionPulpitPublicNews($id)
    {
        $messagesByPulpits = (new Query)
            ->addSelect(['total' => new Expression('COUNT(n.id)')])
            ->addSelect('p.name')
            ->from(['n' => 'college_pulpit_news'])
            ->andWhere(['n.access' => GroupNews::PUBLIC_ACCESS])
            ->innerJoin('college_pulpit p', 'p.id = n.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy('p.id')
            ->all();

        $messagesByDirections = (new Query)
            ->addSelect(['total' => new Expression('COUNT(n.id)')])
            ->addSelect('d.name')
            ->from(['n' => 'college_pulpit_news'])
            ->andWhere(['n.access' => GroupNews::PUBLIC_ACCESS])
            ->innerJoin('college_pulpit p', 'p.id = n.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy('d.id')
            ->all();

        $messagesByPulpitsDataTbl = [];
        foreach ($messagesByPulpits as $item) {
            $messagesByPulpitsDataTbl[] = [$item['name'], (int)$item['total']];
        }

        $messagesByDirectionsDataTbl = [];
        foreach ($messagesByDirections as $item) {
            $messagesByDirectionsDataTbl[] = [$item['name'], (int)$item['total']];
        }

        return $this->render('pulpitPublicNews', [
            'messagesByPulpit' => $messagesByPulpitsDataTbl,
            'messagesByDirection' => $messagesByDirectionsDataTbl
        ]);
    }

    public function actionPulpitPrivateNews($id)
    {
        $messagesByPulpits = (new Query)
            ->addSelect(['total' => new Expression('COUNT(n.id)')])
            ->addSelect('p.name')
            ->from(['n' => 'college_pulpit_news'])
            ->andWhere(['n.access' => GroupNews::PRIVATE_ACCESS])
            ->innerJoin('college_pulpit p', 'p.id = n.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy('p.id')
            ->all();

        $messagesByDirections = (new Query)
            ->addSelect(['total' => new Expression('COUNT(n.id)')])
            ->addSelect('d.name')
            ->from(['n' => 'college_pulpit_news'])
            ->andWhere(['n.access' => GroupNews::PRIVATE_ACCESS])
            ->innerJoin('college_pulpit p', 'p.id = n.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy('d.id')
            ->all();

        $messagesByPulpitsDataTbl = [];
        foreach ($messagesByPulpits as $item) {
            $messagesByPulpitsDataTbl[] = [$item['name'], (int)$item['total']];
        }

        $messagesByDirectionsDataTbl = [];
        foreach ($messagesByDirections as $item) {
            $messagesByDirectionsDataTbl[] = [$item['name'], (int)$item['total']];
        }

        return $this->render('pulpitPrivateNews', [
            'messagesByPulpit' => $messagesByPulpitsDataTbl,
            'messagesByDirection' => $messagesByDirectionsDataTbl
        ]);
    }

    public function actionGroupPrivateNews($id)
    {
        $messagesByPulpits = (new Query)
            ->addSelect(['total' => new Expression('COUNT(n.id)')])
            ->addSelect('p.name')
            ->from(['n' => 'college_group_news'])
            ->andWhere(['n.access' => GroupNews::PRIVATE_ACCESS])
            ->innerJoin('college_group g', 'g.id = n.group_id')
            ->innerJoin('college_pulpit p', 'p.id = g.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy('p.id')
            ->all();

        $messagesByDirections = (new Query)
            ->addSelect(['total' => new Expression('COUNT(n.id)')])
            ->addSelect('d.name')
            ->from(['n' => 'college_group_news'])
            ->andWhere(['n.access' => GroupNews::PRIVATE_ACCESS])
            ->innerJoin('college_group g', 'g.id = n.group_id')
            ->innerJoin('college_pulpit p', 'p.id = g.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy('d.id')
            ->all();

        $messagesByPulpitsDataTbl = [];
        foreach ($messagesByPulpits as $item) {
            $messagesByPulpitsDataTbl[] = [$item['name'], (int)$item['total']];
        }

        $messagesByDirectionsDataTbl = [];
        foreach ($messagesByDirections as $item) {
            $messagesByDirectionsDataTbl[] = [$item['name'], (int)$item['total']];
        }

        return $this->render('groupPrivateNews', [
            'messagesByPulpit' => $messagesByPulpitsDataTbl,
            'messagesByDirection' => $messagesByDirectionsDataTbl
        ]);
    }

    public function actionGroupMessages($id)
    {
        $messagesByPulpits = (new Query)
            ->addSelect(['total' => new Expression('COUNT(m.id)')])
            ->addSelect('p.name')
            ->from(['m' => 'messages'])
            ->innerJoin('user u', '(m.id_recipient = u.id OR m.id_sender = u.id) AND u.group_id IS NOT NULL')
            ->innerJoin('college_group g', 'g.id = u.group_id')
            ->innerJoin('college_pulpit p', 'p.id = g.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy('p.id')
            ->all();

        $messagesByDirections = (new Query())
            ->addSelect(['total' => new Expression('COUNT(m.id)')])
            ->addSelect('d.name')
            ->from(['m' => 'messages'])
            ->innerJoin('user u', '(m.id_recipient = u.id OR m.id_sender = u.id) AND u.group_id IS NOT NULL')
            ->innerJoin('college_group g', 'g.id = u.group_id')
            ->innerJoin('college_pulpit p', 'p.id = g.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy('d.id')
            ->all();

        $messagesByPulpitsDataTbl = [];
        foreach ($messagesByPulpits as $item) {
            $messagesByPulpitsDataTbl[] = [$item['name'], (int)$item['total']];
        }

        $messagesByDirectionsDataTbl = [];
        foreach ($messagesByDirections as $item) {
            $messagesByDirectionsDataTbl[] = [$item['name'], (int)$item['total']];
        }

        return $this->render('groupMessages', [
            'messagesByPulpit' => $messagesByPulpitsDataTbl,
            'messagesByDirection' => $messagesByDirectionsDataTbl
        ]);
    }

    public function actionPulpitMessages($id)
    {
        $messagesByPulpits = (new Query)
            ->addSelect(['total' => new Expression('COUNT(m.id)')])
            ->addSelect('p.name')
            ->from(['m' => 'messages'])
            ->innerJoin('user u', '(m.id_recipient = u.id OR m.id_sender = u.id) AND u.group_id IS NULL')
            ->innerJoin('college_pulpit p', 'p.id = u.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy('p.id')
            ->all();

        $messagesByDirections = (new Query())
            ->addSelect(['total' => new Expression('COUNT(m.id)')])
            ->addSelect('d.name')
            ->from(['m' => 'messages'])
            ->innerJoin('user u', '(m.id_recipient = u.id OR m.id_sender = u.id) AND u.group_id IS NULL')
            ->innerJoin('college_pulpit p', 'p.id = u.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy('d.id')
            ->all();

        $messagesByPulpitsDataTbl = [];
        foreach ($messagesByPulpits as $item) {
            $messagesByPulpitsDataTbl[] = [$item['name'], (int)$item['total']];
        }

        $messagesByDirectionsDataTbl = [];
        foreach ($messagesByDirections as $item) {
            $messagesByDirectionsDataTbl[] = [$item['name'], (int)$item['total']];
        }

        return $this->render('pulpitMessages', [
            'messagesByPulpit' => $messagesByPulpitsDataTbl,
            'messagesByDirection' => $messagesByDirectionsDataTbl
        ]);
    }

    public function actionMessagesInTime($id)
    {
        $groupMsg = (new Query)
            ->addSelect(['total' => new Expression('COUNT(m.id)')])
            ->addSelect('d.name')
            ->addSelect(['year' => new Expression('(FROM_UNIXTIME(m.created_at, \'%Y\'))')])
            ->from(['m' => 'messages'])
            ->innerJoin('user u', '(m.id_recipient = u.id OR m.id_sender = u.id) AND u.group_id IS NOT NULL')
            ->innerJoin('college_group g', 'g.id = u.group_id')
            ->innerJoin('college_pulpit p', 'p.id = g.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy(['d.id', 'year'])
            ->all();

        $pulpitMsg = (new Query)
            ->addSelect(['total' => new Expression('COUNT(m.id)')])
            ->addSelect('d.name')
            ->addSelect(['year' => new Expression('(FROM_UNIXTIME(m.created_at, \'%Y\'))')])
            ->from(['m' => 'messages'])
            ->innerJoin('user u', '(m.id_recipient = u.id OR m.id_sender = u.id) AND u.group_id IS NULL')
            ->innerJoin('college_pulpit p', 'p.id = u.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy(['d.id', 'year'])
            ->all();

        return $this->render('groupMessagesInTime', [
            'msgPulpit' => $this->lineChartDataTable($pulpitMsg, 'year', 'name', 'total'),
            'msgGroup' => $this->lineChartDataTable($groupMsg, 'year', 'name', 'total')
        ]);
    }

    public function actionPublicNewsInTime($id)
    {
        $groupNews = (new Query)
            ->addSelect(['total' => new Expression('COUNT(n.id)')])
            ->addSelect('d.name')
            ->addSelect(['year' => new Expression('(FROM_UNIXTIME(n.created_at, \'%Y\'))')])
            ->from(['n' => 'college_group_news'])
            ->andWhere(['n.access' => PulpitNews::PUBLIC_ACCESS])
            ->innerJoin('college_group g', 'g.id = n.group_id')
            ->innerJoin('college_pulpit p', 'p.id = g.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy(['d.id', 'year'])
            ->all();

        $pulpitNews = (new Query)
            ->addSelect(['total' => new Expression('COUNT(n.id)')])
            ->addSelect('d.name')
            ->addSelect(['year' => new Expression('(FROM_UNIXTIME(n.created_at, \'%Y\'))')])
            ->from(['n' => 'college_pulpit_news'])
            ->andWhere(['n.access' => PulpitNews::PUBLIC_ACCESS])
            ->innerJoin('college_pulpit p', 'p.id = n.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy(['d.id', 'year'])
            ->orderBy(['year' => SORT_DESC])
            ->all();

        return $this->render('publicNewsInTime', [
            'msgPulpit' => $this->lineChartDataTable($pulpitNews, 'year', 'name', 'total'),
            'msgGroup' => $this->lineChartDataTable($groupNews, 'year', 'name', 'total')
        ]);
    }

    public function actionPrivateNewsInTime($id)
    {
        $groupNews = (new Query)
            ->addSelect(['total' => new Expression('COUNT(n.id)')])
            ->addSelect('d.name')
            ->addSelect(['year' => new Expression('(FROM_UNIXTIME(n.created_at, \'%Y\'))')])
            ->from(['n' => 'college_group_news'])
            ->andWhere(['n.access' => PulpitNews::PRIVATE_ACCESS])
            ->innerJoin('college_group g', 'g.id = n.group_id')
            ->innerJoin('college_pulpit p', 'p.id = g.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy(['d.id', 'year'])
            ->all();

        $pulpitNews = (new Query)
            ->addSelect(['total' => new Expression('COUNT(n.id)')])
            ->addSelect('d.name')
            ->addSelect(['year' => new Expression('(FROM_UNIXTIME(n.created_at, \'%Y\'))')])
            ->from(['n' => 'college_pulpit_news'])
            ->andWhere(['n.access' => PulpitNews::PRIVATE_ACCESS])
            ->innerJoin('college_pulpit p', 'p.id = n.pulpit_id')
            ->innerJoin('college_direction d', 'd.id = p.direction_id')
            ->andWhere(['d.college_id' => $id])
            ->groupBy(['d.id', 'year'])
            ->all();

        return $this->render('privateNewsInTime', [
            'msgPulpit' => $this->lineChartDataTable($pulpitNews, 'year', 'name', 'total'),
            'msgGroup' => $this->lineChartDataTable($groupNews, 'year', 'name', 'total')
        ]);
    }

    private function lineChartDataTable($data, $x, $y, $value)
    {
        $msgGroup = [];
        $headers = ['Years' => 0];
        $groupByYear = [];
        $names = [];

        foreach ($data as $item) {
            $groupByYear[$item[$x]][$item[$y]] = (int)$item[$value];
            $names[$item[$y]] = $item[$y];
        }

        foreach ($groupByYear as $year => $ary) {
            $item = [$year];
            $itemNames = $names;
            foreach ($ary as $name => $total) {
                if (isset($itemNames[$name])) {
                    unset($itemNames[$name]);
                }
                if (isset($headers[$name])) {
                    $key = $headers[$name];
                } else {
                    $key = count($headers) + 1;
                    $headers[$name] = $key;
                }
                $item[$key] = $total;
            }
            foreach ($itemNames as $name) {
                if (isset($headers[$name])) {
                    $key = $headers[$name];
                } else {
                    $key = count($headers) + 1;
                    $headers[$name] = $key;
                }
                $item[$key] = 0;
            }
            $msgGroup[] = array_values($item);
        }

        array_unshift($msgGroup, array_values(array_flip($headers)));

        return $msgGroup;
    }

}