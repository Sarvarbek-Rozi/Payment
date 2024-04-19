<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Mixins\ResponseFactoryMixin;
class UserController extends Controller
{
    private $service;
    private $repo;
    protected $response;

    public function __construct()
    {
        $this->service = new UserService();
        $this->repo = new UserRepository();

    }
    public function index(Request $request)
    {
        $users = $this->service->getAll($request);
        return response()->successJson(['users' => $users]);
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function show($id)
    {
        $users = $this->service->show($id);
        $this->response['result'] = [
            'user' =>  $users
        ];
        return response()->json($this->response);
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request, $id);

    }

    public function destroy($id)
    {
        return $this->service->destroy($id);

    }
}
