<?php namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\BaseModel;

abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = ['text','url','form','security','cookie','date','my'];

    protected array $cc = [];
    protected array $ccp = [];
    protected BaseModel $bm;
    protected $session;
    protected $validation;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->session    = \Config\Services::session();
        $this->db         = \Config\Database::connect();
        $this->validation = \Config\Services::validation();

        $this->bm  = model(BaseModel::class);
        $this->cc  = $this->bm->getAllConfig();
        $this->ccp = $this->bm->getPublicConfig();

        $renderer = \Config\Services::renderer();
        $renderer->setVar('cc', $this->cc);
        $renderer->setVar('ccp', $this->ccp);
    }
}
