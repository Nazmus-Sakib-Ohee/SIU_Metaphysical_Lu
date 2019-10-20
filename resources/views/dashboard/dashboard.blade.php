
        
        {{--Header--}}
        @include('dashboard/dash_inc.topbar')

        {{-- Logic Of LeftBar per admin --}}
        @auth
        
        @include('dashboard/dash_inc.leftbar')
             {{-- dashboard --}}
          @include('dashboard/dash_inc.dashboard')

                    @endauth
     

   
          {{--Footer--}}
          @include('dashboard/dash_inc.footerbar')