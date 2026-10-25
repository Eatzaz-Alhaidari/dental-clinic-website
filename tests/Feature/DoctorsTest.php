<?php

namespace Tests\Feature;

use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Service;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoctorsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_doctors_index_page_displays_all_15_doctors(): void
    {
        $response = $this->get('/doctors');

        $response->assertStatus(200);
        $this->assertEquals(15, Doctor::active()->count());

        // Check that some doctors appear on the page
        $response->assertSee('د. عمر بن عبدالعزيز الزهراني');
        $response->assertSee('د. دينا بنت إبراهيم شرف الدين');
        $response->assertSee('د. هيثم بن ناصر باوزير');
    }

    public function test_doctors_can_be_filtered_by_riyadh_branch(): void
    {
        $riyadh = Branch::where('name->ar', 'like', '%الرياض%')->first();
        $this->assertNotNull($riyadh);

        $response = $this->get('/doctors?branch_id=' . $riyadh->id);
        $response->assertStatus(200);

        // Doctor 2 (Sarah) is in Riyadh -> should be visible
        $response->assertSee('د. سارة بنت خالد المنصور');
        // Doctor 4 (Lama) is Jeddah & Taif -> should not be in the Riyadh filtered list
        $response->assertDontSee('د. لمى بنت عبدالله الشريف');
    }

    public function test_doctors_can_be_filtered_by_taif_branch(): void
    {
        $taif = Branch::where('name->ar', 'like', '%الطائف%')->first();
        $this->assertNotNull($taif);

        $response = $this->get('/doctors?branch_id=' . $taif->id);
        $response->assertStatus(200);

        // Doctor 4 (Lama) is in Taif -> should be visible
        $response->assertSee('د. لمى بنت عبدالله الشريف');
        // Doctor 2 (Sarah) is Riyadh & Jeddah -> should not be in the Taif filtered list
        $response->assertDontSee('د. سارة بنت خالد المنصور');
    }

    public function test_doctor_profile_page_loads_successfully(): void
    {
        $doctor = Doctor::find(1);
        $response = $this->get('/doctors/' . $doctor->id);

        $response->assertStatus(200);
        $response->assertSee('د. عمر بن عبدالعزيز الزهراني');
        $response->assertSee('استشاري تقويم وتعديل الأسنان والفكين');
    }

    public function test_inactive_doctor_returns_404(): void
    {
        $doctor = Doctor::find(1);
        $doctor->update(['is_active' => false]);

        $response = $this->get('/doctors/' . $doctor->id);
        $response->assertStatus(404);
    }
}
