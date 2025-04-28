<?php
namespace app\controllers;

use app\forms\PersonSearchForm;
use PDOException;

class PersonListCtrl {

    /** @var PersonSearchForm */
    private $form;

    /** @var array */
    private $records;

    public function __construct() {
        $this->form = new PersonSearchForm();
    }

    public function action_personList() {
        // 1) Получаем параметры фильтра
        $this->form->value = getFromRequest('sf_value');
        $this->form->field = getFromRequest('sf_field');

        // 2) Строим условие WHERE
        $where = [];
        if (!empty($this->form->value)
            && in_array($this->form->field, ['name','surname','birthdate'])
        ) {
            $col = $this->form->field;
            if (in_array($col, ['name','surname'])) {
                // LIKE-поиск
                $where["{$col}[~]"] = $this->form->value;
            } else {
                // точное совпадение по дате
                $where[$col] = $this->form->value;
            }
        }

        // 3) Выполняем запрос через Medoo
        try {
            $this->records = getDB()->select(
                'person',
                ['idperson','name','surname','birthdate'],
                $where
            );
        } catch (PDOException $e) {
            getMessages()->addError('Błąd podczas pobierania danych');
            if (getConf()->debug) {
                getMessages()->addError($e->getMessage());
            }
        }

        // 4) Отдаём переменные в шаблон
        getSmarty()->assign('searchForm', (array)$this->form);
        getSmarty()->assign('people',     $this->records);

        // 5) Рендерим страницу
        getSmarty()->display('PersonList.tpl');
    }
}
