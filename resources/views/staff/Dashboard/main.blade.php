<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                
        <div class="images-container">
            
                <img src="{{asset('') }}assets/images/output-onlinepngtools (3).png" class="logo-icon" alt="logo icon" height = "66px" width = "70px">
            

         
                <img src="{{asset('') }}assets/images/COA_Line__1.png" class="logo-icon" alt="logo icon" height = "66px" width = "5px">
          

          
                <img src="{{asset('') }}assets/images/KSG Logo (1).png" class="logo-icon" alt="logo icon" height = "66px" width = "90px">
         
            
            
        </div>
    </div>
            
        </div>
        <style>
            /* Center aligning container */
            .center-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh; /* Full viewport height */
            }
            .images-container {
            text-align: center;
        }

        
        </style>
        <div class="dash-wrapper">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5 row-cols-xxl-5 row-group">
                <div class="col">
                  
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card-body text-center">
                           <p class="mb-1 text-white">Class Contact Hours</p>  
                           
                           <h3 class="mb-3 text-white"></h3> 
                           <h1 style="color: rgb(120, 14, 213)"></h1>
                           <p class="font-13 text-light-2"<i class="lni lni-arrow-up"></i> Hours</p>
                          
                           <div ></div>
                        </div>
                    </div>
                </div>
                <div class="col">
                   <div class="card bg-transparent shadow-none mb-0">
                       <div class="card-body text-center">
                          <p class="mb-1 text-white">Diary Entries</p>  
                          <h3 class="mb-3 text-white"></h3>
                          <h1 style="color: rgb(14, 239, 115)">{{ $diaryCount }}</h1>
                          <p class="font-13 text-light-2"<i class="lni lni-arrow-up"></i> Total Score</p>
                         
                          <div ></div>
                       </div>
                   </div>
               </div>
               <div class="col">
                   <div class="card bg-transparent shadow-none mb-0">
                       <div class="card-body text-center">
                          <p class="mb-1 text-white">Programme Evaluation Score</p>  
                          <h3 class="mb-3 text-white"></h3>
                          <h3 class="mb-3 text-white"></h3>
                          <h1 style="color: rgb(227, 30, 73)"></h1>
                          <p class="font-13 text-light-2"<i class="lni lni-arrow-up"></i> Evaluation Score</p>
                         
                          <div ></div>
                       </div>
                   </div>
               </div>
               <div class="col">
                   <div class="card bg-transparent shadow-none mb-0">
                       <div class="card-body text-center">
                          <p class="mb-1 text-white">Total Programs Coordinated</p>  
                          <h3 class="mb-3 text-white"></h3><br>
                          <h1 style="color: rgb(206, 232, 10)"</h1>
                         
                          <p class="font-13 text-light-2"><span class="text-white"><i class="lni lni-arrow-up"></i>KSG</span> Programs Coordinated </p>
                          <div ></div>
                       </div>
                   </div>
               </div>
               <div class="col col-md-12">
                   <div class="card bg-transparent shadow-none mb-0">
                       <div class="card-body text-center">
                        <p class="mb-1 text-white">Total Curriculum Reviewed</p>  
                        <h3 class="mb-3 text-white"></h3><br>
                        <h1 style="color: rgb(245, 82, 12)"></h1>
                       
                        <p class="font-13 text-light-2"><span class="text-white"><i class="lni lni-arrow-up"></i></span>Curriculum Reviewed</p>
                          <div ></div>
                       </div>
                   </div>
               </div>
            </div><!--end row-->
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0"></p>
                                <h5 class="mb-0"></h5>
                                <h1 style="color: rgb(213, 239, 12)"></h1>
                            </div>
                            <div class="dropdown ms-auto">
                                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22'></i>
                                </div>
                               
                            </div>
                        </div>
                        <div class="" id="w-chart1"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0"></p>
                                <h5 class="mb-0"></h5>
                                <h1 style="color: rgb(27, 30, 209)"></h1>
                            </div>
                            <div class="dropdown ms-auto">
                                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22'></i>
                                </div>
                                
                            </div>
                        </div>
                        <div class="" id="w-chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0"></p>
                                <h5 class="mb-0"></h5>
                                <h1 style="color: rgb(206, 232, 10)"></h1>
                            </div>
                            <div class="dropdown ms-auto">
                                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22'></i>
                                </div>
                               
                            </div>
                        </div>
                        <div class="" id="w-chart3"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">    </p>
                                <h5 class="mb-0"></h5>
                                <h1 style="color: rgb(233, 129, 17)"></h1>
                            </div>
                            <div class="dropdown ms-auto">
                                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22'></i>
                                </div>
                                
                            </div>
                        </div>
                        <div class="" id="w-chart4"></div>
                    </div>
                </div>
            </div>
            
        </div>
        

       
        

        

        

         <div class="row">
             <div class="col-12 col-lg-6">
                 <div class="card radius-10">
                     <div class="card-body">
                       <div id="chart13"></div>
                     </div>
                 </div>
             </div>
             <div class="col-12 col-lg-6">
               <div class="card radius-10">
                   <div class="card-body">
                       <div id="chart14"></div>
                     </div>
               </div>
           </div>
         </div><!--end row-->
       </div>
</div>