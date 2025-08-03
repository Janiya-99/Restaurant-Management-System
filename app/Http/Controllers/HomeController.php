<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\ChequeBook;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseSubCategory;
use App\Models\Payment;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{


    public function index(Request $request)
    {
        if(auth()->user()->hasRole('User')) {
            return redirect()->route('prescriptions.create');
        }else{
            return redirect()->route('concession.index');
        }
    }


}
