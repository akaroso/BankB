@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
	
	
	
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Account Information') }}</div>
				<div class="card-body">
			<h2>	Account Number: </h2>
			<h2>	Balance:	</h2>
			
			<td>
                <form action="#" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Transfer</button>
                </form>
            </td>
			</div>
				
					 <div class="card-header">
                Operation History
            </div>
				///
				
				
				<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Transfery</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Type</td>
		   <td>Data</td>
		   <td>Amount</td>
		   <td>Status</td>         
        </tr>
    </thead>
    <tbody>
        
        <tr>
            <td>Operacja 1</td>
            <td>Operacja 2</td>
			<td>Data</td>
		   <td>Amount</td>
		   <td>Status</td> 
        </tr>
        
    </tbody>
  </table>
<div>
</div>
				
				
				
				
				
				
				
				
				
				
				
				
				///
                <div class="card-body">
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
