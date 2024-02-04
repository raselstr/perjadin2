<?php

namespace App\Filters;

use App\Models\RolemenusModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        
        $model = new RolemenusModel();
        $url = $request->uri->getSegment(1);
        $permintaan = $url;
        $menurole = $model->datarolefilter(session('role_id'), $permintaan);
        if ($menurole === null) {
            return redirect()->to(site_url('error'));

        } else {
            return $request;
        }
        
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}
