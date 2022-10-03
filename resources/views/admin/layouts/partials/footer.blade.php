@once

<script type="text/javascript">
    window.addEventListener("load", function(){
        $("#kt_footer").show("slow");
});
</script>

<div class="footer bg-transparent d-flex flex-lg-column" id="kt_footer" style="display: none!important">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-bold me-1">{{ date('Y') }}©</span>
            <a href="https://www.aeonx.digital" target="_blank" class="text-gray-800 text-hover-primary"><strong style="color:#F26522">Silwana  Real Estate</strong></a>
        </div>
        <!--end::Copyright-->

    </div>
    <!--end::Container-->
</div>

@endonce
