
<div class="py-5 container text-center">
    <div class="row my-5 justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 mb-4">
            <% if ShowTitle %>
                <h2 class="mb-4">$Title</h2>
            <% end_if %>
            <p>$Content</p>
        </div>
        <div class="w-100"></div>
        <% loop Testimonials %>
            <div class="col-12 col-md-6 col-lg-4 d-flex flex-column align-items-center my-3">
                <div class="px-5">
                    <img src="$Image.URL" alt="$Title" class="w-50 img-fluid rounded-circle shadow">
                </div>
            <p class="mt-4 px-3"><i>"$Quote"</i></p>
                <% if ShowTitle %>
                    <h4 class="mt-4">$Title</h4>
                <% end_if %>
                <% if SubTitle %>
                    <h6><strong>$SubTitle</strong></h6>
                <% end_if %>
            </div>
        <% end_loop %>
    </div>
</div>
