<?php

namespace app\auth\rbac;

use Yii;
use yii\rbac\Rule;
use yii\rbac\ManagerInterface;





/**
 * Verifica se o ID DO Usuario ou do Pai corresponde ao usuário passado via  parâmetro
 */
class OperadorRule extends Rule {
    public $name = 'isOperador';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params) {
        if (isset($params['model'])) { //Directly specify the model you plan to use via param
            $model = $params['model'];
        } else { //Use the controller findModel method to get the model - this is what executes via the behaviour/rules
            $id = Yii::$app->request->get('id'); //Note, this is an assumption on your url structure.
            $model = Yii::$app->controller->findUserModel($id); //Note, this only works if you change findModel to be a public function within the controller.
        }

	    //Retorna os papéis que são atribuídos ao usuário.
	    $papeis = Yii::$app->authManager->getRolesByUser($model->id_num_cri);
	    $papel = implode(`, `, array_keys($papeis));
	    //Retorna funções filhas da função especificada. Profundidade não é limitado.
	    $funFilha =  Yii::$app->authManager->getChildRoles($papel);
	    return (array_key_exists($papel,$funFilha));
    }

}
