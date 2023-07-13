<x-first/> 

<section class="wf100 ">
<img src="{{asset($pages->image)}}" class="" style="width:100%" alt="">
            <div class="container">
               <h2> {{($pages->title)}}</h2>
               <ul>
                
                  <li> <a href="index.php">Home</a> </li>
                  <li> <a href="#"> {{($pages->title)}} </a> </li>
                 
               </ul>
            </div></img>
         </section>
         <section>
            <div class="container">
                <!-- displaying unescaped data  -->
       {!!($pages->editor)!!} </div>
         </section>
<x-footer/> 