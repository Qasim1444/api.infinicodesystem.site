<div style="background-color: #f9fafb; padding: 20px; font-family: Arial, sans-serif;">
    <div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">

        <!-- Header -->
        <div style="background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%); padding: 30px 20px; text-align: center; color: white;">
            <h1 style="margin: 0; font-size: 28px; font-weight: bold;">New Blog Post Published 📝</h1>
        </div>

        <!-- Content -->
        <div style="padding: 30px 20px;">
            <p style="margin: 0 0 20px 0; font-size: 16px; color: #333;">Hi there,</p>

            <p style="margin: 0 0 20px 0; font-size: 15px; color: #666; line-height: 1.6;">
                We've just published a new blog post that we think you'll love!
            </p>

            <!-- Post Card -->
            <div style="background-color: #f3f4f6; border-left: 4px solid #7c3aed; padding: 20px; margin: 20px 0; border-radius: 4px;">
                <h2 style="margin: 0 0 10px 0; color: #1f2937; font-size: 20px;">{{ $post->title }}</h2>

                @if($post->category)
                <p style="margin: 0 0 10px 0; display: inline-block; background-color: #7c3aed; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">
                    {{ $post->category->name }}
                </p>
                <br>
                @endif

                <p style="margin: 10px 0 0 0; color: #6b7280; font-size: 13px;">
                    Published on {{ $post->created_at->format('F j, Y') }}
                </p>
            </div>

            <!-- CTA Button -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ url('http://localhost:3000/blog/' . $post->slug) }}"
                   style="display: inline-block; background-color: #7c3aed; color: white; padding: 12px 30px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 16px;">
                    Read Full Post →
                </a>
            </div>

            <p style="margin: 20px 0 0 0; font-size: 14px; color: #999;">
                Happy reading! If you have any feedback, feel free to reach out.
            </p>
        </div>

        <!-- Footer -->
        <div style="background-color: #f9fafb; border-top: 1px solid #e5e7eb; padding: 20px; text-align: center; font-size: 12px; color: #999;">
            <p style="margin: 0 0 10px 0;">
                © 2026 Web Agency. All rights reserved.
            </p>
            <p style="margin: 0;">
                You're receiving this email because you subscribed to our newsletter.
            </p>
        </div>
    </div>
</div>
