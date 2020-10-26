<div class="row justify-content-center text-center">
    <% if ShowTitle || Content %>
        <div class="{$ElementName}__contentholder col-12 col-md-10 col-lg-8 mb-4">
            <% if ShowTitle %>
                <h2 class="mb-4 {$ElementName}__title">$Title</h2>
            <% end_if %>
            <% if $Content %>
            <p class="{$ElementName}__content">$Content</p>
            <% end_if %>
        </div>
    <% end_if %>
    <div class="w-100"></div>
    <% loop Testimonials %>
        <div class="{$ElementName}__testimonial col-12 col-md-6 col-lg-4 d-flex flex-column align-items-center my-3">
            <div class="{$ElementName}__testimonial-image px-5">
                <img src="$Image.URL" alt="$Title" class="w-50 img-fluid rounded-circle shadow">
            </div>
            <% if ShowTitle %>
                <h3 class="{$ElementName}__testimonial-title mt-4">$Title</h3>
            <% end_if %>
            <% if SubTitle %>
                <div class="{$ElementName}__testimonial-subtitle">
                    <lead><strong>$SubTitle</strong></lead>
                </div>
            <% end_if %>
        <p class="{$ElementName}__testimonial-quote mt-4 px-3"><i>"$Quote"</i></p>
        </div>
    <% end_loop %>
</div>
