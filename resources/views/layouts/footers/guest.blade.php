<footer class="footer">
    <div class="container-fluid">
        <nav class="float-left">
            <ul>
                <li>
                    <a href="{{route('public.home')}}">
                        {{ __('Home') }}
                    </a>
                </li>
                <li>
                    <a href="{{route('public.about')}}">
                        {{ __('About Us') }}
                    </a>
                </li>
                <li>
                    <a href="{{route('public.blog')}}">
                        {{ __('Blog') }}
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright float-right">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim Templates</a> by <a href="#" target="_blank">Amilcar Coronado</a>.
        </div>
    </div>
</footer>