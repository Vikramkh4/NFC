<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Noauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedIn')) {

			if (session()->get('role') == "admin") {
				return redirect()->to(base_url('admin'));
			}

			elseif (session()->get('role') == "vendor") {
				return redirect()->to(base_url('vendor'));
			}
            else{
                return redirect()->to(base_url("user"));
            }


        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}