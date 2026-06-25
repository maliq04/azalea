<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title'        => 'How to Write the Perfect Wedding Invitation Wording',
                'slug'         => 'perfect-wedding-invitation-wording',
                'excerpt'      => 'Crafting the right words for your wedding invitation sets the tone for your entire celebration. From formal to casual, we walk you through every style.',
                'body'         => '<p>Your wedding invitation is often the first glimpse guests get of your big day. The wording you choose communicates not just the logistical details — date, time, venue — but also the <em>feeling</em> of your celebration.</p>

<h2>Start with the hosts</h2>
<p>Traditionally, the invitation opens by naming whoever is hosting the wedding. If both sets of parents are contributing, you might write: <em>"Together with their families, Anisa Maharani and Bima Saputra request the honour of your presence…"</em></p>

<h2>Formal vs. informal tone</h2>
<p>A black-tie affair calls for full formal language — spell out all words (no abbreviations), use "honour" and "favour" in their British spelling, and keep sentences measured and classical. For a garden party wedding you can relax considerably: <em>"Join us as we celebrate!"</em> works perfectly.</p>

<h2>Include all the essentials</h2>
<ul>
<li>Full names of both partners</li>
<li>Day of the week, date, and year</li>
<li>Ceremony start time</li>
<li>Full venue name and address</li>
<li>Reception details (if separate)</li>
<li>RSVP deadline and contact</li>
</ul>

<h2>A note on dress code</h2>
<p>If you have a specific dress code, include it tastefully at the bottom of the invitation or on a separate enclosure card. "Black tie", "garden chic", or "batik encouraged" are all great options depending on your theme.</p>

<p>Remember: your invitation is a keepsake. Many couples frame them after the wedding. Make it something worth preserving.</p>',
                'author'       => 'Azalea Team',
                'category'     => 'Tips',
                'read_time'    => 5,
                'published'    => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title'        => '10 Wedding Invitation Trends to Watch This Year',
                'slug'         => 'wedding-invitation-trends-this-year',
                'excerpt'      => "From sustainable materials to bold maximalist designs, this year's invitation trends are anything but boring. Discover what couples are loving right now.",
                'body'         => '<p>Wedding invitations have evolved far beyond folded card stock slipped into a plain envelope. Couples today are using their invitations as a full brand identity for their wedding — and designers are delivering.</p>

<h2>1. Vellum overlay jackets</h2>
<p>A translucent vellum sheet printed with florals or calligraphy wrapped around the main invitation creates a dreamy, layered effect that photographs beautifully.</p>

<h2>2. Wax seals</h2>
<p>The wax seal trend isn\'t going anywhere. Custom monogram seals in dusty rose, sage green, or midnight navy add a heritage touch that guests love to receive.</p>

<h2>3. Maximalist florals</h2>
<p>Gone are the days of tiny corner sprigs. Full-bleed botanical illustrations in vivid colour are having a major moment, especially for outdoor and garden weddings.</p>

<h2>4. Earthy, sustainable materials</h2>
<p>Seed paper, recycled kraft card, and soy-based inks are increasingly popular among eco-conscious couples. Some invitations can even be planted after the wedding to grow wildflowers.</p>

<h2>5. Digital-physical hybrid suites</h2>
<p>Couples are pairing a physical invitation with a beautifully designed wedding website QR code embedded in a letterpress card. Guests get the warmth of print with the convenience of digital.</p>

<h2>6. Illustrated venue portraits</h2>
<p>Custom watercolour or line-art illustrations of the wedding venue are a charming personalisation that doubles as a memento.</p>

<h2>7. Monochromatic colour stories</h2>
<p>Choosing a single hue and working in tints and shades — all blush, or all navy — creates a cohesive, editorial look across the full invitation suite.</p>

<h2>8. Hand-lettered calligraphy</h2>
<p>Authentic hand lettering, not just a calligraphy font, adds genuine artisan quality. Many Azalea designs support adding a calligraphy name flourish.</p>

<h2>9. Mini booklets</h2>
<p>Instead of a flat card, some couples opt for a small saddle-stitched booklet containing the invitation, schedule, venue map, accommodation details, and even a short love story.</p>

<h2>10. Interactive digital invitations</h2>
<p>For guests far away, an animated digital invitation with RSVP built in is both practical and impressive — especially when it matches the physical suite perfectly.</p>',
                'author'       => 'Azalea Team',
                'category'     => 'Inspiration',
                'read_time'    => 7,
                'published'    => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title'        => 'A Complete Guide to Wedding Invitation Timeline',
                'slug'         => 'wedding-invitation-timeline-guide',
                'excerpt'      => 'Timing is everything. Find out exactly when to order, address, and mail your wedding invitations so nothing gets left to the last minute.',
                'body'         => '<p>One of the most common wedding planning mistakes is underestimating how long the invitation process takes. Between design, printing, addressing, and mailing, it\'s easy to find yourself scrambling. This guide gives you a clear timeline to follow.</p>

<h2>12 months before: Choose your design direction</h2>
<p>Even if you won\'t print anything yet, now is the time to browse invitation styles and identify the aesthetic you want. Lock in your colour palette, typography preferences, and overall feel. This ensures your invitation aligns with other design decisions you\'ll make — venue decor, florals, stationery.</p>

<h2>8–10 months before: Send save-the-dates</h2>
<p>Save-the-dates should go out 8–10 months before the wedding, and up to 12 months in advance for destination weddings. These are simpler than the full invitation — just the date, city/region, and your wedding website URL.</p>

<h2>6 months before: Finalise your guest list</h2>
<p>Collect accurate mailing addresses for every guest. This is more work than it sounds. Build a shared spreadsheet and chase every last address — you\'ll thank yourself later.</p>

<h2>4–5 months before: Order invitations</h2>
<p>Place your order at least 4–5 months before the wedding date. This gives you time for design revisions, printing, any addressing services, assembly, and a safety buffer for reprints.</p>

<h2>10–12 weeks before: Mail invitations</h2>
<p>Standard advice is to mail 6–8 weeks before the wedding. But 10–12 weeks is safer and allows guests more time to arrange travel and accommodation, especially if you have guests coming from abroad.</p>

<h2>3–4 weeks before: RSVP deadline</h2>
<p>Set your RSVP deadline 3–4 weeks before the wedding. You need time to give final numbers to your caterer and venue, so don\'t cut it too close.</p>

<h2>After RSVPs close: Follow up</h2>
<p>Personally contact any guests who haven\'t replied by the deadline. A quick phone call or message resolves it quickly.</p>

<h2>A word on digital invitations</h2>
<p>If you\'re going fully digital, the same timeline applies — you still need to collect email addresses in advance and allow time for design iterations.</p>',
                'author'       => 'Azalea Team',
                'category'     => 'Guide',
                'read_time'    => 8,
                'published'    => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title'        => 'Choosing the Right Font Pairing for Your Wedding Invitation',
                'slug'         => 'wedding-invitation-font-pairing',
                'excerpt'      => "Typography makes or breaks a wedding invitation. Here's how to choose font pairings that feel cohesive, elegant, and perfectly matched to your wedding style.",
                'body'         => '<p>Typography is one of the most powerful — and most overlooked — tools in wedding design. The right font pairing can transform a plain card into something that feels genuinely luxurious. Here\'s how to get it right.</p>

<h2>The golden rule: contrast without conflict</h2>
<p>Great font pairings contrast each other in style while sharing a common feeling. A flowing script headline pairs beautifully with a clean, modern serif for body text. Both feel elegant, but they\'re visually distinct enough to create hierarchy.</p>

<h2>Script fonts: romantic but use sparingly</h2>
<p>Script and calligraphy fonts are beloved in wedding stationery for good reason — they feel personal, warm, and celebratory. But using script everywhere makes everything compete for attention. Limit script to names, headings, or a single decorative line.</p>

<h2>Serif fonts: timeless and versatile</h2>
<p>Classic serifs like Garamond, Cormorant, or Playfair Display are workhorses of elegant print design. They work at any size and convey heritage and quality. Use them for the body of your invitation where readability matters most.</p>

<h2>Sans-serif fonts: modern and clean</h2>
<p>If your wedding aesthetic leans contemporary or minimalist, a geometric sans-serif like Futura or a humanist sans like Gill Sans gives the invitation a fresh, modern edge. Pair with a thin script for warmth.</p>

<h2>Limit yourself to two fonts</h2>
<p>The most common mistake is using too many fonts. Two fonts — one display, one body — is almost always enough. If you want variety, explore the weights and styles within a single font family.</p>

<h2>Check legibility at print size</h2>
<p>Always proof your invitation at actual print size before finalising. A font that looks exquisite on screen can become unreadable at 10pt on a 5×7 card. Request a printed proof from your printer.</p>',
                'author'       => 'Azalea Team',
                'category'     => 'Tips',
                'read_time'    => 6,
                'published'    => true,
                'published_at' => now()->subDays(15),
            ],
            [
                'title'        => 'Digital vs. Printed Wedding Invitations: Which Is Right for You?',
                'slug'         => 'digital-vs-printed-wedding-invitations',
                'excerpt'      => 'Can\'t decide between digital and print? We break down the pros, cons, and considerations of each so you can make the choice that fits your wedding — and your budget.',
                'body'         => '<p>In 2024 and beyond, the choice between digital and printed wedding invitations is more nuanced than ever. Both have genuine advantages, and many couples are choosing a hybrid approach. Here\'s an honest breakdown.</p>

<h2>Printed invitations</h2>

<h3>Pros</h3>
<ul>
<li><strong>Tangible keepsake:</strong> Many guests keep and frame beautiful printed invitations. They become part of the story of your day.</li>
<li><strong>No technical barriers:</strong> Elderly relatives and guests who aren\'t tech-savvy receive something they can hold and read easily.</li>
<li><strong>Design range:</strong> Letterpress, foil stamping, die-cutting, and embossing are only possible in print.</li>
<li><strong>Sets a tone:</strong> Receiving a beautiful physical invitation builds excitement in a way that an email notification doesn\'t.</li>
</ul>

<h3>Cons</h3>
<ul>
<li><strong>Cost:</strong> Quality print suites can be expensive, especially with custom printing techniques.</li>
<li><strong>Time:</strong> Design, printing, and delivery takes weeks.</li>
<li><strong>Environmental impact:</strong> Paper, printing inks, and shipping all have a footprint.</li>
<li><strong>Address collection:</strong> You need physical mailing addresses, which can be surprisingly hard to gather.</li>
</ul>

<h2>Digital invitations</h2>

<h3>Pros</h3>
<ul>
<li><strong>Cost-effective:</strong> Far cheaper than print, especially for large guest lists.</li>
<li><strong>Fast:</strong> Design, send, and RSVP all in days, not months.</li>
<li><strong>Interactive:</strong> Embedded RSVP forms, links to your wedding website, Google Maps, and even video messages.</li>
<li><strong>Eco-friendly:</strong> No paper, no shipping, no waste.</li>
</ul>

<h3>Cons</h3>
<ul>
<li><strong>Spam risk:</strong> Email invitations can land in spam folders and miss guests entirely.</li>
<li><strong>Less special:</strong> A beautiful email is still just an email. It doesn\'t have the weight and presence of physical mail.</li>
<li><strong>Technical barriers:</strong> Not all guests are comfortable managing digital RSVPs.</li>
</ul>

<h2>The hybrid approach</h2>
<p>Many couples send beautiful printed invitations to close family and elder guests, and digital invitations to younger, tech-comfortable guests. This balances cost, environmental impact, and sentiment perfectly.</p>

<p>Whichever route you choose, Azalea\'s templates are designed to work beautifully in both formats.</p>',
                'author'       => 'Azalea Team',
                'category'     => 'Guide',
                'read_time'    => 9,
                'published'    => true,
                'published_at' => now()->subDays(20),
            ],
            [
                'title'        => 'How to Personalise Your Wedding Invitation on a Budget',
                'slug'         => 'personalise-wedding-invitation-budget',
                'excerpt'      => "A stunning, personalised wedding invitation doesn't have to cost a fortune. These smart design and printing tips help you create something beautiful without breaking the bank.",
                'body'         => '<p>You don\'t need a lavish budget to have an invitation suite that feels personal and beautiful. With the right template, a little creativity, and some strategic choices, you can create something truly special for a fraction of typical costs.</p>

<h2>Start with a great template</h2>
<p>A professionally designed template is already 80% of the work. Choose one with typography and layout that feel close to your vision — that minimises the customisation you need to do and reduces the chance of design mistakes.</p>

<h2>Personalise with photos</h2>
<p>If your template supports a photo, use a beautiful engagement shoot photo. A single well-chosen image transforms a generic design into something that is unmistakably yours.</p>

<h2>Customise the colour palette</h2>
<p>Even a simple colour change — swapping the default blush pink for terracotta, or navy for forest green — makes a template look completely different. Most Azalea templates allow full colour customisation.</p>

<h2>Add a monogram</h2>
<p>A monogram combining both partners\' initials is a classic personalisation that adds elegance without requiring expensive design work. Many fonts support beautiful ligature combinations.</p>

<h2>Print smart</h2>
<ul>
<li><strong>Digital printing vs. letterpress:</strong> Digital printing is far cheaper and still produces beautiful results. Letterpress is stunning but costs 3–5× more.</li>
<li><strong>Standard sizes save money:</strong> Unusual die-cut shapes and oversize formats cost more to print and to post. Stick to standard A6 or 5×7 sizes.</li>
<li><strong>Print quantity carefully:</strong> Print 10–20 extras to account for mistakes and late additions. Over-ordering by 100 is wasteful.</li>
</ul>

<h2>DIY envelope addressing</h2>
<p>Instead of paying a calligrapher to address envelopes, print address labels using a matching font, or use a free handwriting font that coordinates with your invitation. It\'s not identical to hand calligraphy but it looks intentional and cohesive.</p>

<h2>Forgo the full suite for casual weddings</h2>
<p>A full invitation suite — invitation, details card, RSVP card, envelope liner, wax seal — is beautiful but not necessary. For casual or intimate weddings, a single well-designed card with a QR code to your wedding website does everything in one.</p>',
                'author'       => 'Azalea Team',
                'category'     => 'Inspiration',
                'read_time'    => 6,
                'published'    => true,
                'published_at' => now()->subDays(25),
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }
    }
}
