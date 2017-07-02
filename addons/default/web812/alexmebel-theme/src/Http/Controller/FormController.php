<?php namespace Web812\AlexmebelTheme\Http\Controller;

use Illuminate\Support\Facades\Validator;
use Web812\AlexmebelTheme\Command\SendMailToManager;

class FormController extends \Anomaly\Streams\Platform\Http\Controller\FormController
{

    /**
     * Handle user request
     *
     * @return Response
     */
    public function request()
    {
        dd($this->request->method());
        // if (!$this->request->ajax() || $this->request->method() != 'post')
        // {
        //     return $this->redirect->to('/');
        // }

        $data = $this->request->all();

        $validator = Validator::make($data, ['phone' => 'required']);

        if ($validator->fails())
        {
            return $this->returnError($validator->errors());
        }

        if (!$this->dispatch(new SendMailToManager($data)))
        {
            return $this->returnError('Can\'t send mail');
        }

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
