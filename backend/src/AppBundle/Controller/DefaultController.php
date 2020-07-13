<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Services\Helpers;
use AppBundle\Services\JwtAuth;

use AppBundle\Entity\User;
use AppBundle\Entity\Employee;


class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    public function loginAction(Request $request){
        $helpers = $this->get(Helpers::class);

        //get json post
        $json = $request->get('json', null);
        $data = array(
            'status'=>'error',
            'data'=>'Send json via post.'
        );

        if($json != null){

            $params = json_decode($json);

            $username = (isset($params->username)) ? $params->username : null;
            $password = (isset($params->password)) ? $params->password : null;
            $getHash = (isset($params->getHash)) ? $params->getHash : null;

            $pwd = hash('sha256', $password);

            if($username != null && $password != null){

                $jwt_auth = $this->get(JwtAuth::class);

                if($getHash == null || $getHash == false){
                    $signup = $jwt_auth->signup($username, $pwd);
                }else{
                    $signup = $jwt_auth->signup($username, $pwd, true);
                }

                return $this->json($signup);

            }else{
                $data = array(
                    'status'=>'error',
                    'data'=>'Username or password Incorrect.'
                );
            }
        }

        return $helpers->json($data);
    }

    public function userDetailAction(Request $request, $id = null){
		$helpers = $this->get(Helpers::class);
		$jwt_auth = $this->get(JwtAuth::class);

		$token = $request->get("authorization",null);
		$authCheck = $jwt_auth->checkToken($token);

		if($authCheck){
			$identity = $jwt_auth->checkToken($token, true);

			$em = $this->getDoctrine()->getManager();
			$user = $em->getRepository(User::class)->findOneBy(array(
				'id'=>$id
            ));
            
            $employee = $em->getRepository(Employee::class)->findOneBy(array(
				'id'=>$user->getEmp_id()
			));

			if($user && is_object($user) && $identity->sub == $user->getId()) {
				$data = array(
					'status'=>'success',
					'code'	=>200,
                    'data'	=>$employee,
                    'user_id'=>$id,
					'msg'	=>'User detail'
				);
			}else{
				$data = array(
					'status'=>'error',
					'code'	=>400,
					'msg'	=>'Employee not found'
				);
			}

			
		}else{
			$data = array(
				'status'=>'error',
				'code'	=>400,
				'msg'	=>'Authorization not valid'
			);
		}

		return $helpers->json($data);
	}

}
