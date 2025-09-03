<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tips extends Model
{
    use HasFactory;

    public function randomCards($currentUrl)
    {
        $cards = [
            [
                'image' => 'user-friendly.avif',
                'title' => 'User-Friendly Interface',
                'description' =>
                'Design an intuitive interface that guides users effortlessly. Implement clear navigation, logical layout, and familiar design patterns to enhance usability and provide a positive user experience.',
                'url' => 'user-friendly',
            ],
            [
                'image' => 'quality-content.webp',
                'title' => 'Quality Content',
                'description' =>
                'Quality content is crucial for engaging visitors and establishing authority. Provide valuable, relevant information that addresses audience needs. This improves user experience and boosts search rankings.',
                'url' => 'quality-content',
            ],
            [
                'image' => 'easy-navigation.png',
                'title' => 'Easy Navigation',
                'description' =>
                'Create a clear, intuitive navigation structure. Well-organized menus and logical page hierarchy help visitors find information quickly, improving user experience.',
                'url' => 'easy-navigation',
            ],
            [
                'image' => 'seo.jpg',
                'title' => 'SEO Optimization',
                'description' =>
                'Implement SEO best practices to improve your website\'s visibility in search engine results. This includes optimizing content, meta tags, and building quality backlinks.',
                'url' => 'seo-optimization',
            ],
            [
                'image' => 'responsive-design.jpg',
                'title' => 'Responsive Design',
                'description' =>
                'Ensure your website is fully responsive and works well on all devices, especially mobile phones. With increasing mobile usage, this is crucial for user experience and SEO.',
                'url' => 'responsive-design',
            ],
            [
                'image' => 'clear-goal.avif',
                'title' => 'Set Clear Goals',
                'description' =>
                'Establish clear, specific goals for your website to guide its development and measure success. This includes defining your target audience, desired outcomes, and key performance indicators (KPIs).',
                'url' => 'clear-goal',
            ],
        ];

        $filteredCards = array_filter($cards, function ($card) use ($currentUrl) {
            return !str_contains($currentUrl, $card['url']);
        });

        shuffle($filteredCards);
        $selectedCards = array_slice($filteredCards, 0, 3);
        return $selectedCards;
    }
}
