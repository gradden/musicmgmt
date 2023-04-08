<?php

namespace App\Console\Commands;

use App\Repository\ClubRepository;
use App\Repository\ConcertRepository;
use App\Repository\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class InitOldConcerts extends Command
{
    protected $signature = 'init-old-concerts';
    protected $description = 'Initialize old concerts from "fellepesek" app\'s exported DB data (only from JSON format!)';
    private ConcertRepository $concertRepository;
    private ClubRepository $clubRepository;
    private UserRepository $userRepository;

    public function __construct(
        ConcertRepository $concertRepository, 
        ClubRepository $clubRepository,
        UserRepository $userRepository,
    ) {
        parent::__construct();
        $this->concertRepository = $concertRepository;
        $this->clubRepository = $clubRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $json = file_get_contents(storage_path('/app/esemenyek.json'));
        $data = json_decode($json, true);
        foreach ($data as $item){
            if (array_key_exists('data', $item)) {
                $concerts = $item['data'];
            }
        }
        
        $defaultEmail = config('app.default_user_email_for_import') ?? '';
        if (!$this->userRepository->isExists($defaultEmail)) 
        {
            throw new Exception(__('errors.import_fail'), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        $user = $this->userRepository->firstBy('email', $defaultEmail);

        DB::transaction(function() use ($concerts, $user) {
            $this->initClubs($concerts);
            $this->initConcerts($concerts, $user->id);
        });
    }

    private function initClubs(array $concerts)
    {      
        foreach ($concerts as $concert) 
        {
            $helyszin = html_entity_decode($concert['helyszin']);
            $varos = html_entity_decode($concert['varos']);
            $this->clubRepository->updateOrCreate([
                'name' => $helyszin,
                'location' => $varos
            ], 'name');
        }
    }

    private function initConcerts(array $concerts, int $userId)
    {
        foreach($concerts as $concert)
        {
            $id = $concert['id'];
            $helyszin = html_entity_decode($concert['helyszin']);
            $leiras = html_entity_decode($concert['leiras']);
            if (empty($leiras)) {
                $leiras = $helyszin;
            } 
            $income = 0;
            $eventStart = Carbon::parse($concert['datum']);
            $eventEnd = Carbon::parse($concert['datum']);

            switch ($id) {
                case 47:
                    $eventStart->addDay()->addMinutes(30);
                    $eventEnd->addDay()->addHours(5);
                    break;
                case 64:
                    $eventStart->addDay()->addHours(3);
                    $eventEnd->addDay()->addHours(5);
                    break;
                case 74:
                    $eventStart->addDay()->addHours(1);
                    $eventEnd->addDay()->addHours(2);
                    break;
                case 75:
                    $eventStart->addDay()->addHours(3);
                    $eventEnd->addDay()->addHours(5);
                    $income = 50000;
                    break;
                case 81:
                    $eventStart->addDay();
                    $eventEnd->addDay()->addHours(2);
                    break;
                case 83:
                    $eventStart->addDay()->addHours(2);
                    $eventEnd->addDay()->addHours(3);
                    break;
                case 84:
                    $eventStart->addHours(23);
                    $eventEnd->addDay()->addHour(1);
                    break;
                case 87:
                    $eventStart->addDay()->addHours(1);
                    $eventEnd->addDay()->addHours(2)->addMinutes(30);
                    break;
                case 88:
                    $eventStart->addDay()->addHours(3);
                    $eventEnd->addDay()->addHours(4);
                    break;
                case 89:
                    $eventStart->addDay()->addHours(1)->addMinutes(30);
                    $eventEnd->addDay()->addHours(3);
                    break;
                case 93:
                    $eventStart->addDay()->addHours(2);
                    $eventEnd->addDay()->addHours(4);
                    $income = 30000;
                    break;
                case 101:
                    $eventStart->addDay();
                    $eventEnd->addDay()->addHours(2);
                    $income = 30000;
                    break;
                case 106:
                    $income = 30000;
                    break;
                case 118:
                    $eventStart->addHours(22);
                    $eventEnd->addDay();
                    break;
                case 119:
                    $eventStart->addDay()->addHours(3);
                    $eventEnd->addDay()->addHours(4)->addMinutes(30);
                    break;
                case 120:
                    $eventStart->addDay()->addHours(2)->addMinutes(30);
                    $eventEnd->addDay()->addHours(4);
                    break;
                case 125:
                    $eventStart->addDay()->addHours(3)->addMinutes(30);
                    $eventEnd->addDay()->addHours(5);
                    break;
                case 126:
                    $eventStart->addDay()->addHours(1);
                    $eventEnd->addDay()->addHours(2);
                    break;
                default:
                    $eventStart->addDay();
                    $eventEnd->addDay()->addHour();
                    $income = 0;
                    break;
            }

            $eventStart = $eventStart->toDateTimeString();
            $eventEnd = $eventEnd->toDateTimeString();

            $club = $this->clubRepository->getBy('name', $helyszin);
            $this->concertRepository->create([
                'eventName' => $leiras,
                'clubId' => $club->id,
                'createdBy' => $userId,
                'description' => $leiras . ' / (Imported from "fellepesek" app)',
                'eventStartDate' => $eventStart,
                'eventEndDate' => $eventEnd,
                'income' => $income,
                'facebookUrl' => empty($concert['esemeny']) ? null : $concert['esemeny'],
                'livesetUrl' => empty($concert['liveset']) ? null : $concert['liveset'],
                'isExpired' => true
            ]);
        }
    }
}
