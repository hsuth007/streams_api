<?php
namespace Src\Controller;

use Src\TableGateways\StreamGateway;

class StreamController {

    private $db;
    private $requestMethod;
    private $streamId;

    private $streamGateway;

    public function __construct($db, $requestMethod, $streamId)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->streamId = $streamId;

        $this->streamGateway = new StreamGateway($db);
    }

    public function processRequest()
    {
        if($this->requestMethod = 'GET') {
        
            if ($this->streamId) {
                $response = $this->getStreamById($this->streamId);
            } else {
                $response = $this->getAllStreams();
            };
        } else {
            $response = $this->responseNotFound();
        }

        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getAllStreams()
    {
        $result = $this->streamGateway->searchAllStreams();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function getStreamById($id)
    {
        $result = $this->streamGateway->searchByStreamId($id);
        if (! $result) {
            return $this->responseNotFound();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    
    private function validateStream($input)
    {
        if (! isset($input['id'])) {
            return false;
        }
        return true;
    }

    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    private function responseNotFound()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
