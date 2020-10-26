<div class="row justify-content-center text-center">
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
            <% if ShowTitle %>
                <h3 class="mt-4">$Title</h3>
            <% end_if %>
            <% if SubTitle %>
            <lead><strong>$SubTitle</strong></lead>
            <% end_if %>
            <p class="mt-4 px-3"><i>"$Quote"</i></p>
        </div>
    <% end_loop %>
</div>
