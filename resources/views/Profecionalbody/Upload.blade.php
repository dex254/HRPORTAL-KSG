@include('admin.Dashboard.header')
<div class="page-wrapper">
    <div class="page-content">


        <div class="container-fluid">
            <div class="main-content">
                <div class="card border-top border-0 border-4 border-white">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-user me-1 font-22 text-white"></i>
                            </div>
                            <h5 class="mb-0 text-white">Upload  the  exell  with  the proffecional body </h5>
                            <div class="col">
                                </div>
                        </div>
                        <hr>
                        <div>
                            <ul>
                                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
             
                        <form class="row g-3"  action="{{ route('Profecionalbody.Upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label for="formFileMultiple" class="form-label">Upload an exell document:</label>
                                    <input class="form-control" type="file" id="formFileMultiple"  name="file" accept=".xlsx, .xls, .csv" multiple />
                                </div>
                            </div>
                            
                            
                        </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-light px-5">UPLOAD</button>
                            </div>
                        </form>
                    </div>
                </div>
               
                
            <div></div></div>




</div></div>


    </div>

</div>


@include('admin.Dashboard.footer')