<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
 
class VideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Substitua a busca do usuário por isso:
        $user = User::firstOrCreate(
            ['email' => 'alessandro@olharqueprotege.com'], // Busca por esse e-mail
            [
                'nome' => 'Alessandro',
                'password' => Hash::make('alequeprotege709'),
            ] // Cria apenas se NÃO encontrar
        );
 
        // Lista de vídeos correspondente à estrutura da tela e arquivos na pasta storage
        $videos = [
            [
                'titulo'    => 'Terceiro Vídeo de Apresentação',
                'descricao' => 'Breve descrição do Terceiro Vídeo Inicial de Apresentação',
                'arquivo'   => 'videos/F8PCdITz4DZyiOxnpjSmiwkAWCImENfxwPm1fbTB.mp4',
                'user_id'   => $user->id,
            ],
            [
                'titulo'    => 'Segundo Vídeo de Apresentação',
                'descricao' => 'Breve descrição do Segundo Vídeo Inicial de Apresentação',
                'arquivo'   => 'videos/PFJ9OKMDGK7nS4jk8ZeOZH5DtXv8eTTk.mp4', // ajuste a extensão caso não seja .mp4
                'user_id'   => $user->id,
            ],
            [
                'titulo'    => 'Vídeo Inicial de Apresentação',
                'descricao' => 'Breve descrição do Vídeo Inicial de Apresentação',
                'arquivo'   => 'videos/urEmwu5kZDEfYINjFScZZa78vazf0Xk3U3.mp4', // ajuste a extensão caso não seja .mp4
                'user_id'   => $user->id,
            ],
        ];
<<<<<<< HEAD
 
=======

>>>>>>> a3039a46724457f9d0c51443afafd34f37be68d5
        foreach ($videos as $video) {
            Video::create($video);
        }
    }
}