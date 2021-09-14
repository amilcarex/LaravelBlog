  <section class="container-social-networks d-flex @if(isset($current_page) && $current_page == 'about' || isset($current_page) && $current_page == 'blog') about @endif">
      @if($social_settings->facebook != null)
      <a class="container-network" href="{{$social_settings->facebook}}" target="_blank">
          <i class="fab fa-facebook md-social-icons"></i>
      </a>
      @endif

      @if($social_settings->twitter != null)
      <a class="container-network" href="{{$social_settings->twitter}}" target="_blank">
          <i class="fab fa-twitter md-social-icons"></i>
      </a>
      @endif

      @if($social_settings->linkedIn != null)
      <a class="container-network" href="{{$social_settings->linkedIn}}" target="_blank">
          <i class="fab fa-linkedin md-social-icons"></i>
      </a>
      @endif

      @if($social_settings->youtube != null)
      <a class="container-network" href="{{$social_settings->youtube}}" target="_blank">
          <i class="fab fa-youtube md-social-icons"></i>
      </a>
      @endif

      @if($social_settings->instagram != null)
      <a class="container-network" href="{{$social_settings->instagram}}" target="_blank">
          <i class="fab fa-instagram md-social-icons"></i>
      </a>
      @endif

      @if($social_settings->github != null)
      <a class="container-network" href="{{$social_settings->github}}" target="_blank">
          <i class="fab fa-github md-social-icons"></i>
      </a>
      @endif

      @if($social_settings->twitch != null)
      <a class="container-network" href="{{$social_settings->twitch}}twitch" target="_blank">
          <i class="fab fa-twitch md-social-icons"></i>
      </a>
      @endif
  </section>