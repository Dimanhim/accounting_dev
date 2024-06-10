<?php

namespace common\widgets\quiz;

use common\models\Quiz;
use yii\base\Widget;

class QuizWidget extends Widget
{
    const SESSION_NAME = 'acc_quiz_sess';

    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_RADIO = 'radio';
    const TYPE_INPUT = 'input';
    const TYPE_TEXTAREA = 'textarea';

    public $print = false;


    public $_session_id = null;
    private $_session = null;
    private $_quiz_model = null;
    private $_quiz_data  = null;            // вопросы/ответы квиза
    private $_user_data  = null;            // вопросы/ответы юзера

    public $_results = [
        1 => [
            'text' => 'Мы не смогли выяснить Ваши потребности в складском учете товаров.<br>
        К сожалению, по результатам опроса предложить Вам ничего не можем.',
            'result' => false,
            'desc' => '',
            'conditions' => [
                [
                    'question_id' => 7,
                    'answer_ids' => [1],
                    'condition' => '',
                ],
            ],
        ],
        2 => [
            'text' => 'Мы подготовили для Вас специальное предложение для вывода Вашего магазина на маркетплейсы.',
            'result' => true,
            'desc' => '',
            'conditions' => [
                [
                    'question_id' => 3,
                    'answer_ids' => [3],
                    'condition' => '',
                ],
                [
                    'question_id' => 7,
                    'answer_ids' => [3,4,5],
                    'condition' => '',
                ],
            ],
        ],
        3 => [
            'text' => 'Мы подготовили для Вас специальное предложение для упрощения работы с маркетплейсами.',
            'result' => true,
            'desc' => '',
            'conditions' => [
                [
                    'question_id' => 4,
                    'answer_ids' => [1],
                    'condition' => '',
                ],
                [
                    'question_id' => 6,
                    'answer_ids' => '*',
                    'condition' => '',
                ],
                [
                    'question_id' => 7,
                    'answer_ids' => [3,4,5],
                    'condition' => 'or',
                ]
            ],
        ],
        4 => [
            'text' => 'Мы подготовили для Вас специальное предложение для организации системы товарооборота. К тому же, мы сможем помочь Вам начать продавать товары на маркетплейсах.',
            'result' => true,
            'desc' => '',
            'conditions' => [
                [
                    'question_id' => 3,
                    'answer_ids' => [3],
                    'condition' => '',
                ],
                [
                    'question_id' => 6,
                    'answer_ids' => false,
                    'condition' => 'or',
                ],
                [
                    'question_id' => 7,
                    'answer_ids' => [2],
                    'condition' => '',
                ]
            ],
        ],
        5 => [
            'text' => 'Мы подготовили для Вас специальное предложение для перехода из сторонних систем товарооборота к нам. К тому же, в любой момент мы сможем помочь Вам начать продавать товары на маркетплейсах.',
            'result' => true,
            'desc' => '',
            'conditions' => [
                [
                    'question_id' => 2,
                    'answer_ids' => '*',
                    'condition' => '',
                ],
                [
                    'question_id' => 3,
                    'answer_ids' => [3],
                    'condition' => 'not',
                ],
            ],
        ],
        6 => [
            'text' => 'Мы подготовили для Вас специальное предложение для общего контроля товарооборота без использования различных таблиц и других подручных средств.',
            'result' => true,
            'desc' => '',
            'conditions' => [
                [
                    'question_id' => 3,
                    'answer_ids' => '*',
                    'condition' => '',
                ],
                [
                    'question_id' => 3,
                    'answer_ids' => [3],
                    'condition' => 'not',
                ],
            ],
        ],
        7 => [
            'text' => 'Мы подготовили для Вас специальное предложение для организации системы онлайн-учета товаров.',
            'result' => true,
            'desc' => '',
            'conditions' => '',
        ],
    ];

    public function init()
    {
        $this->_session = \Yii::$app->session;
        $this->initSession();
        $this->setQuizModel();
        $this->setQuizData();
        $this->setUserData();

        return parent::init();
    }

    /**
     * @return string|void
     */
    public function run()
    {
        if($this->print) {

            $userData = $this->preparePrintData();

            return $this->render('print', [
                'userData' => $userData,
            ]);
        }
        $userData = $this->renderUserData();

        return $this->render('default', [
            'userData' => $userData,
        ]);
    }

    public function preparePrintData()
    {
        $data = [];

        if($this->_user_data and isset($this->_user_data['questions']) and $this->_user_data['questions']) {
            foreach($this->_user_data['questions'] as $question) {
                if(!$question['user_answers']) continue;

                foreach($question['user_answers'] as $userAnswerId) {
                    $data[$question['question_id'] . ' - ' . $question['name']][] = $this->getAnswerName($question['question_id'], $userAnswerId);
                }
            }
        }

        return $data;
    }

    public function getAnswerName($questionId, $answerId)
    {
        if(isset($this->_quiz_data[$questionId]) and $this->_quiz_data[$questionId]['answers']) {
            foreach($this->_quiz_data[$questionId]['answers'] as $answer) {
                if($answer['answer_id'] == $answerId) return $answer['answer_id'] . ' - ' . $answer['name'];
            }
        }
        return false;
    }

    public function renderUserData()
    {
        //$userData = $this->getUnfilledUserQuestion();

        $currentQuestion = $this->getCurrentQuestion();

        if($currentQuestion == 'result') {
            $data = $this->getResultData();
            $viewName = 'result';
        }
        elseif($currentQuestion) {
            $viewName = 'question';
            $data =  $currentQuestion;
        }
        else {
            $viewName = 'empty';
            $data = [];
        }

        //$data = $this->getResultData();
        //$viewName = 'result';

        return $this->render($viewName, [
            'data' => $data,
        ]);
    }

    private function initSession()
    {
        // закомментить условие для сброса сессии
        if(!$sessionId = $this->getSessionId()) {
            $this->setSessionId();
        }

        if(!$this->_session_id) {
            $this->_session_id = $this->getSessionId();
        }
        $this->setUserStructure();
    }
    public function setSessionId()
    {
        $this->_session->set(self::SESSION_NAME, mt_rand(100000,10000000));
    }
    public function getSessionId()
    {
        return $this->_session->get(self::SESSION_NAME);
    }

    /**
     * _quiz_data
     * устанавливает отсортированный массив с данными квиза
     */
    private function setQuizData()
    {
        $this->_quiz_data = $this->getWidgetData();
    }

    /**
     * _user_data
     * устанавливает массив с заполненными данными юзера
     */
    private function setUserData() {
        if($quiz = $this->_quiz_model) {
            if($quiz->result and ($quizData = json_decode($quiz->result, true))) {
                $this->_user_data = $quizData;
            }
        }
    }

    /**
     * создает запись в таблице с первоначальными значениями
     *
     * @return bool
     */
    private function setUserStructure()
    {
        if(($structure = $this->getStructure()) and !$this->quizExists()) {
            $quiz = new Quiz();
            $quiz->session_id = $this->_session_id;
            $quiz->result = $structure;
            return $quiz->save();
        }
        return false;
    }

    private function quizExists()
    {
        return Quiz::findModels()->andWhere(['session_id' => $this->_session_id])->exists();
    }

    private function setQuizModel()
    {
        $this->_quiz_model = Quiz::findModels()->andWhere(['session_id' => $this->_session_id])->one();
    }

    private function getStructure()
    {
        $data = [
            'user_phone' => '',
            'user_name' => '',
            'user_result_id' => 0,
            'questions' => [],
        ];

        if($widgetData = $this->getWidgetData()) {
            foreach($widgetData as $questionId => $questionValues) {
                $data['questions'][$questionId] = [
                    'question_id' => $questionValues['question_id'],
                    'name' => $questionValues['name'],
                    'user_answers' => [],

                ];
            }
        }
        return json_encode($data);
    }

    public function getUserQuestion($questionId)
    {
        if($this->_user_data and isset($this->_user_data['questions']) and isset($this->_user_data['questions'][$questionId])) {
            return $this->_user_data['questions'][$questionId];
        }
        return false;
    }

    public function getResultData()
    {
        $resultId = $this->getResultId();

        return $this->getResult($resultId);
    }

    public function getResultId()
    {
        //\Yii::$app->infoLog->add('userData', $this->_user_data, 'user-data-log.txt');
        if($this->_user_data and isset($this->_user_data['questions'])) {
            foreach($this->_user_data['questions'] as $userDataQuestion) {
                $userAnswers = $userDataQuestion['user_answers'];
                if($resultId = $this->compareConditionsResultId($userDataQuestion['question_id'], $userAnswers)) {
                    return $resultId;
                }
            }
        }
        return false;
    }

    public function compareConditionsResultId($questionId, $userAnswers)
    {
        if($this->getCurrentQuestion() !== 'result') return false;

        $userQuestions = $this->_user_data['questions'];

        //\Yii::$app->infoLog->add('', $this->_results, 'result-results.txt');
        //\Yii::$app->infoLog->add('', $userQuestions, 'result-user_questions.txt');

        if($this->_results) {
            foreach($this->_results as $resultId => $result) {
                if($conditions = $result['conditions']) {
                    $result = false;
                    foreach($conditions as $condition) {

                        $userQuestion = $userQuestions[$condition['question_id']] ?? null;
                        $userAnswerIds = $userQuestion['user_answers'];

                        $resultAnswerIds = $condition['answer_ids'];

                        $result = $this->isUserAnswerTrue($userAnswerIds, $resultAnswerIds, $condition['condition']);

                        if(!$result) break;
                    }
                    if($result) return $resultId;
                }
            }
        }
        return 7;
    }

    public function isUserAnswerTrue($userAnswerIds, $resultAnswerIds, $condition)
    {
        // нужно перебрать каждый ответ на вопрос и сравнить с ответами юзера

        // если ответа на вопрос быть не должно
        if(!$resultAnswerIds) {
            return empty($userAnswerIds);
        }

        if($resultAnswerIds == '*') {
            return !empty($userAnswerIds);
        }

        // если условие не строгое, то в ответах юзера должно быть хоть одно совпадение
        if(!$condition or $condition == 'or') {
            if(is_array($resultAnswerIds)) {
                foreach($resultAnswerIds as $resultAnswerId) {
                    if(in_array($resultAnswerId, $userAnswerIds)) return true;
                }
            }
        }

        // если условие строгое and - все ответы юзера должны совпасть
        if($condition == 'and') {
            if(is_array($resultAnswerIds)) {
                foreach($resultAnswerIds as $resultAnswerId) {
                    if(!in_array($resultAnswerId, $userAnswerIds)) return false;
                }
                return true;
            }
        }

        // если условие not, то в ответах юзера не должно быть совпадения
        if($condition == 'not') {
            if(is_array($resultAnswerIds)) {
                foreach($resultAnswerIds as $resultAnswerId) {
                    if(in_array($resultAnswerId, $userAnswerIds)) return false;
                }
            }
        }
        return false;
    }


    public function setFilledQuestions($questionId, $answers)
    {
        if(!$answers) return false;

        if(isset($this->_user_data['questions']) and isset($this->_user_data['questions'][$questionId])) {
            $this->_user_data['questions'][$questionId]['user_answers'] = $answers;
            return $this->saveModelResult($this->_user_data);
        }

        return false;
    }

    public function saveModelResult($resultJson)
    {
        if(!$resultJson) return false;
        if($resultJson and ($result = json_encode($resultJson))) {
            $this->_quiz_model->result = $result;
            if($this->_quiz_model->save()) {
                $this->setQuizModel();
                return true;
            }
        }
        return false;
    }

    public function saveUserData()
    {
        if($result = json_encode($this->_user_data)) {
            $this->_quiz_model->result = $result;
            if($this->_quiz_model->save()) {
                $this->setQuizModel();
                return true;
            }
        }
        return false;
    }

    /*public function getDataQuestionFromUser($currentQuestion)
    {
        if(array_key_exists($currentQuestion['question_id'], $this->_quiz_data)) {
            return $this->_quiz_data[$currentQuestion['question_id']];
        }
        return false;
    }*/

    /**
     * сортирует DATA
     *
     * @return array
     */
    private function getWidgetData()
    {
        $data = [];

        $widgetData = $this->getData();

        uasort($widgetData, function($a, $b) {
            return $a['sort'] >= $b['sort'] ? 1 : -1;
        });

        foreach($widgetData as $questionKey => $questionValues) {
            $data[$questionKey] = $questionValues;
            $answers = $questionValues['answers'];
            uasort($answers, function($a, $b) {
                return $a['sort'] >= $b['sort'] ? 1 : -1;
            });
            $data[$questionKey]['answers'] = $answers;
        }
        return $data;
    }

    // сложные условия ответов
    public function getUserAnswerId(array $question, $userAnswers)
    {
        if(!$question or !$userAnswers) return false;

        switch ($question['question_id']) {
            case 3 : {
                if(in_array(3, $userAnswers)) return 3;
            }
                break;
        }

        $firstQuestionKey = array_key_first($userAnswers);
        return $userAnswers[$firstQuestionKey];
    }

    // метод, который получает вопрос в зависимости от имеющихся ответов юзера
    public function getCurrentQuestion($questionId = null)
    {
        $firstQuestionId = $questionId ?? array_key_first($this->_quiz_data);
        if(!$firstQuestionId) return false;

        $question = $this->_quiz_data[$firstQuestionId];

        $userQuestion = $this->getUserQuestion($firstQuestionId);

        if($userQuestion['user_answers']) {
            $userAnswerId = $this->getUserAnswerId($question, $userQuestion['user_answers']);
            $redirectQuestionId = $question['answers'][$userAnswerId]['redirect_question_id'];
            if($redirectQuestionId == 'result') return 'result';
            return $this->getCurrentQuestion($redirectQuestionId);
        }
        return $question;
    }

    public function getQuestionById($questionId)
    {
        return $this->_quiz_data[$questionId] ?? null;
    }

    /**
     * тестовый метод
     *
     * @return array
     */
    private function getData()
    {
        return [
            1 => [
                'question_id' => 1,
                'name' => 'Используете ли Вы складской учет товаров в данный момент?',
                'description' => '',
                'sort' => 1,
                'type' => self::TYPE_RADIO,
                'answers' => [
                    1 => [
                        'answer_id' => 1,
                        'name' => 'Да',
                        'description' => '',
                        'proirity' => false,
                        'redirect_question_id' => 2,
                        'sort' => 1,
                    ],
                    2 => [
                        'answer_id' => 2,
                        'name' => 'Нет',
                        'description' => '',
                        'proirity' => false,
                        'redirect_question_id' => 3,
                        'sort' => 2,
                    ],
                ],
                'user_answers' => [],
                'user_phone' => '',
            ],
            2 => [
                'question_id' => 2,
                'name' => 'Каким способом Вы осуществляете товарный учет?',
                'description' => '',
                'sort' => 2,
                'type' => self::TYPE_CHECKBOX,
                'answers' => [
                    1 => [
                        'answer_id' => 1,
                        'name' => 'Записная книжка',
                        'description' => '',
                        'proirity' => false,
                        'redirect_question_id' => 3,
                        'sort' => 1,
                    ],
                    2 => [
                        'answer_id' => 2,
                        'name' => 'Таблицы Excel, Google и др.',
                        'description' => '',
                        'proirity' => false,
                        'redirect_question_id' => 3,
                        'sort' => 2,
                    ],
                    3 => [
                        'answer_id' => 3,
                        'name' => 'Пользуюсь онлайн системами товарооборота',
                        'description' => '',
                        'proirity' => false,
                        'redirect_question_id' => 3,
                        'sort' => 3,
                    ],
                    4 => [
                        'answer_id' => 4,
                        'name' => 'Пользуюсь 1С',
                        'description' => '',
                        'proirity' => false,
                        'redirect_question_id' => 3,
                        'sort' => 4,
                    ],
                    5 => [
                        'answer_id' => 5,
                        'name' => 'Встроенные системы товарооборота интернет-магазинов 1С-Битрикс и др.',
                        'description' => '',
                        'proirity' => false,
                        'redirect_question_id' => 3,
                        'sort' => 5,
                    ],
                    6 => [
                        'answer_id' => 6,
                        'name' => 'Другое',
                        'description' => '',
                        'proirity' => false,
                        'redirect_question_id' => 3,
                        'sort' => 6,
                    ],
                ],
                'user_answers' => [],
                'user_phone' => '',
            ],
            3 => [
                'question_id' => 3,
                'name' => 'Для чего Вам необходим складской учет товаров?',
                'description' => '',
                'sort' => 3,
                'type' => self::TYPE_CHECKBOX,
                'answers' => [
                    1 => [
                        'answer_id' => 1,
                        'name' => 'Контроль товаров онлайн, чтобы избавиться от Excel таблиц и других способов учета',
                        'description' => '',
                        'redirect_question_id' => 4,
                        'sort' => 1,
                    ],
                    2 => [
                        'answer_id' => 2,
                        'name' => 'Контроль за оборотом товаров и их остатками на складах',
                        'description' => '',
                        'redirect_question_id' => 4,
                        'sort' => 2,
                    ],
                    3 => [
                        'answer_id' => 3,
                        'name' => 'Хочу начать продавать товары на маркетплейсах',
                        'description' => '',
                        'redirect_question_id' => 5,
                        'sort' => 3,
                    ],
                    4 => [
                        'answer_id' => 4,
                        'name' => 'Формирование отчетных/бухгалтерских документов',
                        'description' => '',
                        'redirect_question_id' => 4,
                        'sort' => 4,
                    ],
                ],
                'user_answers' => [],
                'user_phone' => '',
            ],
            4 => [
                'question_id' => 4,
                'name' => 'Продаете ли Вы товары на маркетплейсах?',
                'description' => '',
                'sort' => 4,
                'type' => self::TYPE_RADIO,
                'answers' => [
                    1 => [
                        'answer_id' => 1,
                        'name' => 'Да',
                        'description' => '',
                        'redirect_question_id' => 6,
                        'sort' => 1,
                    ],
                    2 => [
                        'answer_id' => 2,
                        'name' => 'Нет, но планирую',
                        'description' => '',
                        'redirect_question_id' => 5,
                        'sort' => 2,
                    ],
                    3 => [
                        'answer_id' => 3,
                        'name' => 'Нет и не планирую',
                        'description' => '',
                        'redirect_question_id' => 7,
                        'sort' => 3,
                    ],
                ],
                'user_answers' => [],
                'user_phone' => '',
            ],
            5 => [
                'question_id' => 5,
                'name' => 'На каких маркетплейсах планируете продавать товары?',
                'description' => '',
                'sort' => 5,
                'type' => self::TYPE_CHECKBOX,
                'answers' => [
                    1 => [
                        'answer_id' => 1,
                        'name' => 'На Wildberries',
                        'description' => '',
                        'redirect_question_id' => 7,
                        'sort' => 1,
                    ],
                    2 => [
                        'answer_id' => 2,
                        'name' => 'На Ozon',
                        'description' => '',
                        'redirect_question_id' => 7,
                        'sort' => 2,
                    ],
                    3 => [
                        'answer_id' => 3,
                        'name' => 'На Яндекс Маркете',
                        'description' => '',
                        'redirect_question_id' => 7,
                        'sort' => 3,
                    ],
                    4 => [
                        'answer_id' => 4,
                        'name' => 'На всех перечисленных',
                        'description' => '',
                        'redirect_question_id' => 7,
                        'sort' => 4,
                    ],
                    5 => [
                        'answer_id' => 5,
                        'name' => 'Ни на одном из перечисленных',
                        'description' => '',
                        'redirect_question_id' => 7,
                        'sort' => 5,
                    ],
                ],
                'user_answers' => [],
                'user_phone' => '',
            ],
            6 => [
                'question_id' => 6,
                'name' => 'На каких маркетплейсах Вы продаете товары?',
                'description' => '',
                'sort' => 6,
                'type' => self::TYPE_CHECKBOX,
                'answers' => [
                    1 => [
                        'answer_id' => 1,
                        'name' => 'На Wildberries',
                        'description' => '',
                        'redirect_question_id' => 7,
                        'sort' => 1,
                    ],
                    2 => [
                        'answer_id' => 2,
                        'name' => 'На Ozon',
                        'description' => '',
                        'redirect_question_id' => 7,
                        'sort' => 2,
                    ],
                    3 => [
                        'answer_id' => 3,
                        'name' => 'На Яндекс Маркете',
                        'description' => '',
                        'redirect_question_id' => 7,
                        'sort' => 3,
                    ],
                    4 => [
                        'answer_id' => 4,
                        'name' => 'Ни на одном из перечисленных',
                        'description' => '',
                        'redirect_question_id' => 7,
                        'sort' => 4,
                    ],
                ],
                'user_answers' => [],
                'user_phone' => '',
            ],
            7 => [
                'question_id' => 7,
                'name' => 'У Вас есть магазин для продажи товаров?',
                'description' => '',
                'sort' => 7,
                'type' => self::TYPE_RADIO,
                'answers' => [
                    1 => [
                        'answer_id' => 1,
                        'name' => 'Нет и не планирую, просто интересуюсь',
                        'description' => '',
                        'redirect_question_id' => 8,
                        'sort' => 1,
                    ],
                    2 => [
                        'answer_id' => 2,
                        'name' => 'Нет магазина, но планирую открыть',
                        'description' => '',
                        'redirect_question_id' => 8,
                        'sort' => 2,
                    ],
                    3 => [
                        'answer_id' => 3,
                        'name' => 'Есть офлайн магазин, но планирую продавать и в интернете',
                        'description' => '',
                        'redirect_question_id' => 8,
                        'sort' => 3,
                    ],
                    4 => [
                        'answer_id' => 4,
                        'name' => 'Есть Wildberries, Ozon или Яндекс Маркет',
                        'description' => '',
                        'redirect_question_id' => 8,
                        'sort' => 4,
                    ],
                    5 => [
                        'answer_id' => 5,
                        'name' => 'Есть сайт интернет-магазина',
                        'description' => '',
                        'redirect_question_id' => 8,
                        'sort' => 5,
                    ],
                ],
                'user_answers' => [],
                'user_phone' => '',
            ],
            8 => [
                'question_id' => 8,
                'name' => 'Какое у Вас примерное количество товаров?',
                'description' => '',
                'sort' => 8,
                'type' => self::TYPE_RADIO,
                'answers' => [
                    1 => [
                        'answer_id' => 1,
                        'name' => 'до 100',
                        'description' => '',
                        'redirect_question_id' => 9,
                        'sort' => 1,
                    ],
                    2 => [
                        'answer_id' => 2,
                        'name' => 'от 100 до 1000',
                        'description' => '',
                        'redirect_question_id' => 9,
                        'sort' => 2,
                    ],
                    3 => [
                        'answer_id' => 3,
                        'name' => 'более 1000',
                        'description' => '',
                        'redirect_question_id' => 9,
                        'sort' => 3,
                    ],
                ],
                'user_answers' => [],
                'user_phone' => '',
            ],
            9 => [
                'question_id' => 9,
                'name' => 'Требуются документы для бухгалтерии?',
                'description' => '',
                'sort' => 9,
                'type' => self::TYPE_RADIO,
                'answers' => [
                    1 => [
                        'answer_id' => 1,
                        'name' => 'Да',
                        'description' => '',
                        'redirect_question_id' => 'result',
                        'sort' => 1,
                    ],
                    2 => [
                        'answer_id' => 2,
                        'name' => 'Нет',
                        'description' => '',
                        'redirect_question_id' => 'result',
                        'sort' => 2,
                    ],
                    3 => [
                        'answer_id' => 3,
                        'name' => 'Не знаю',
                        'description' => '',
                        'redirect_question_id' => 'result',
                        'sort' => 3,
                    ],
                ],
                'user_answers' => [],
                'user_phone' => '',
            ],
        ];
    }



    public function setContactValues($name = null, $phone = null)
    {
        \Yii::$app->infoLog->add('user_data', $this->_user_data);
        if(!$name or !$phone) return false;

        $this->_user_data['user_name'] = $name;
        $this->_user_data['user_phone'] = $phone;
        $this->_user_data['user_result_id'] = $this->getResultId();

        if($this->saveUserData()) {
            return $this->render('_success');
        }

        return false;
    }


    public function getForm($data)
    {
        return $this->render('_form', [
            'data' => $data,
        ]);
    }

    public function getResult($resultId)
    {
        if(!isset($this->_results[$resultId])) return false;

        $result = $this->_results[$resultId];

        return $this->render('result_template', [
            'result' => $result,
            'resultId' => $resultId
        ]);
    }

    public function isQuizFilled()
    {
        if($this->_user_data and isset($this->_user_data['user_phone'])) {
            return $this->_user_data['user_phone'];
        }
        return false;
    }
}

