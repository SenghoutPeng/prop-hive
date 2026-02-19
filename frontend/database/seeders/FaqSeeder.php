<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('faqs')->insert([
            [
                'FAQs_question' => 'What are your office hours?',
                'FAQs_answer' => 'We are open Monday to Friday, 9 AM to 6 PM, and Saturday 10 AM to 4 PM.',
            ],
            [
                'FAQs_question' => 'How do I schedule a property viewing?',
                'FAQs_answer' => 'You can schedule a viewing through our website or by calling our office directly.',
            ],
            [
                'FAQs_question' => 'What documents do I need to rent a property?',
                'FAQs_answer' => 'You will need a valid ID, proof of income, references, and a security deposit.',
            ],
            [
                'FAQs_question' => 'Are pets allowed in rental properties?',
                'FAQs_answer' => 'Pet policies vary by property. Please check the specific listing or contact us for details.',
            ],
            [
                'FAQs_question' => 'What is your cancellation policy?',
                'FAQs_answer' => 'Cancellation policies depend on the lease agreement. Generally, 30 days notice is required.',
            ],
            [
                'FAQs_question' => 'Do you offer property management services?',
                'FAQs_answer' => 'Yes, we offer comprehensive property management services including maintenance, tenant screening, and rent collection.',
            ],
        ]);
    }
}