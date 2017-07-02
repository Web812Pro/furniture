<?php namespace Web812\AlexmebelTheme\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Support\Facades\Validator;
use Web812\AlexmebelTheme\Command\SendMailToManager;

class FormController extends PublicController
{

    /**
     * Handle user request
     *
     * @return Response
     */
    public function userRequest()
    {
        if (!$this->request->ajax() || $this->request->method() != 'POST')
        {
            return $this->redirect->to('/');
        }

        $data = array_except($this->request->all(), ['_token']) ;

        $validator = Validator::make($data, ['phone' => 'required']);

        if ($validator->fails())
        {
            return $this->returnError($validator->errors());
        }

        $this->dispatch(new SendMailToManager($data));

        return $this->returnSuccess($data);
    }

    /**
     * Returns error response
     *
     * @param  string     $error The error
     * @return Response
     */
    private function returnError($error = '')
    {
        return $this->response->json([
            'success' => false,
            'error'   => $error,
            'request' => $this->request->all(),
        ], 400);
    }

    /**
     * Returns error response
     *
     * @param  array      $entry The entry
     * @return Response
     */
    private function returnSuccess($entry = [])
    {
        return $this->response->json([
            'success' => true,
            'data'    => $entry,
            'request' => $this->request->all(),
        ], 200);
    }
}
