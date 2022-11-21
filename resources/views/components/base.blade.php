<!DOCTYPE html>
<html lang="en">
<x-header />
<body>
    <x-bodyHeader />

        {{$slot}}
    @php
        $unique_id = ''; $email = ''; $name = ''; $phone = '';   @endphp
    @if (Auth::guard('front')->check())
        @php
            $unique_id = Auth::guard('front')->user()->id;
            $email     = Auth::guard('front')->user()->email;
            $name      = Auth::guard('front')->user()->name;
            $phone     = Auth::guard('front')->user()->phone;
        @endphp
    @endif
    <x-bodyFooter/>
    <x-footer/>

@yield('scripts')
    <script src="//code.tidio.co/53wnvqxnwveczmideotentdqobrsrx00.js" async></script>
    <!-- Start of LiveChat (www.livechat.com) code
    <script>
        window.__lc = window.__lc || {};
        window.__lc.license = 14751207;
        ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
    </script>
    <noscript><a href="https://www.livechat.com/chat-with/14751207/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
     End of LiveChat code -->

</body>
<script type="text/javascript">
    @if (Auth::guard('front')->check())
        document.tidioIdentify =
            {   distinct_id: '{{$unique_id}}', // Unique visitor ID in your system
                email: '{{$email}}', // visitor email
                name: '{{$name}}', // Visitor name
                phone: '{{$phone}}' //Visitor phone};
            };
     @else
     //   tidioChatApi.setVisitorData({  email: "",  name: "",   phone: "",  distinct_id: ''});
    @endif

    @if (count($errors) > 0)
    $('#login-modal').modal('show');
    @endif
</script>
</html>
