<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Penulis
        $admin = User::create([
            'name' => 'Redaksi Utama',
            'email' => 'redaksi@portal.com',
            'password' => bcrypt('password'),
        ]);

        $jurnalis = User::create([
            'name' => 'Budi Jurnalis',
            'email' => 'budi@portal.com',
            'password' => bcrypt('password'),
        ]);

        // 2. Buat Kategori
        $tekno = Category::create(['name' => 'Teknologi', 'slug' => 'teknologi']);
        $bola = Category::create(['name' => 'Sepak Bola', 'slug' => 'sepak-bola']);
        $oto = Category::create(['name' => 'Otomotif', 'slug' => 'otomotif']);

        // 3. Buat Berita REAL (Manual)
        
        // Berita 1: Teknologi
        Post::create([
            'title' => 'Mengenal Gemini AI: Kecerdasan Buatan Terbaru Pesaing ChatGPT',
            'slug' => 'mengenal-gemini-ai-pesaing-chatgpt',
            'excerpt' => 'Google resmi meluncurkan Gemini, model AI tercanggih yang diklaim mampu mengalahkan kemampuan manusia dalam beberapa tes.',
            'body' => '<p>Google akhirnya merilis Gemini, model kecerdasan buatan (AI) terbaru dan tercanggih mereka. Gemini dirancang untuk menjadi pesaing utama ChatGPT buatan OpenAI.</p><p>Kelebihan utama Gemini adalah sifatnya yang multimodal, artinya ia bisa memahami teks, gambar, audio, dan video sekaligus. Dalam demo resminya, Gemini terlihat mampu menganalisis video secara realtime dan memberikan respons yang sangat natural.</p><p>Teknologi ini diharapkan akan mengubah cara kita menggunakan mesin pencari dan asisten digital di masa depan.</p>',
            'category_id' => $tekno->id,
            'user_id' => $admin->id,
            'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&q=80&w=800' // Foto AI Robot
        ]);

        // Berita 2: Bola
        Post::create([
            'title' => 'Timnas Indonesia Siap Tempur di Kualifikasi Piala Dunia',
            'slug' => 'timnas-indonesia-siap-tempur',
            'excerpt' => 'Pelatih Shin Tae-yong optimis skuad Garuda bisa memberikan kejutan melawan tim-tim raksasa Asia.',
            'body' => '<p>Semangat membara menyelimuti skuad Timnas Indonesia jelang laga krusial Kualifikasi Piala Dunia 2026. Dengan tambahan beberapa pemain naturalisasi grade A, kekuatan Garuda kini tidak bisa dipandang sebelah mata.</p><p>Shin Tae-yong menekankan pentingnya disiplin dan fisik. "Kami tidak takut siapapun lawannya. Bola itu bundar," ujar pelatih asal Korea Selatan tersebut.</p><p>Para suporter diharapkan memadati stadion untuk memberikan dukungan penuh bagi perjuangan Marselino Ferdinan dan kawan-kawan.</p>',
            'category_id' => $bola->id,
            'user_id' => $jurnalis->id,
            'image' => 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?auto=format&fit=crop&q=80&w=800' // Foto Bola
        ]);

        // Berita 3: Otomotif
        Post::create([
            'title' => 'Mobil Listrik Semakin Murah, Penjualan Meningkat 200 Persen',
            'slug' => 'mobil-listrik-semakin-murah',
            'excerpt' => 'Persaingan harga antar produsen mobil listrik membuat harga semakin terjangkau bagi masyarakat Indonesia.',
            'body' => '<p>Era kendaraan listrik (EV) di Indonesia semakin nyata. Data terbaru menunjukkan lonjakan penjualan hingga 200% dibanding tahun lalu. Hal ini dipicu oleh masuknya brand-brand baru yang menawarkan harga kompetitif.</p><p>Pemerintah juga terus memberikan insentif berupa potongan pajak untuk pembelian mobil listrik rakitan lokal. Infrastruktur SPKLU (Stasiun Pengisian Kendaraan Listrik Umum) juga terus diperbanyak di rest area dan pusat perbelanjaan.</p><p>Apakah ini saat yang tepat untuk beralih ke mobil listrik? Banyak pengamat bilang: YA.</p>',
            'category_id' => $oto->id,
            'user_id' => $admin->id,
            'image' => 'https://images.unsplash.com/photo-1593941707882-a5bba14938c7?auto=format&fit=crop&q=80&w=800' // Foto Mobil
        ]);
        
        // Tambahan: Generate 5 berita random sisa buat ngeramein (opsional)
        Post::factory(5)->create();
    }
}