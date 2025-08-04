<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmittedDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Real encrypted data from the SQL dump - safe to include since it's encrypted
        $data = [
            ['type' => 'donations', '_id' => 'LQB0-2HDE-9850', 'rec' => 'KBAMDcN0vJWuYGLmFRHIMK5oogqpyx/cyCO6P5GnPML1T99U9UBJOt3eZNoh1vKsXxWQXN2q+B4nOS51zlPj9WslBe697wvsupTcIZVYCJsmsvT/7clW3pkvpAwahhzb/hV2dBxGYimM6InQaOlBu0mWoyOA6fp2RktYL0lgloZJYiFQ9tPe1unhi4dJRsWOryKAcEQMN9uytvVf7/9v0N2ABwWceeAiiltSNukFGfqbmbqvFegwPFP9VWRSe5Y367EzOsx3TZLkYSyChkD9mw==', 'send_response' => null],
            ['type' => 'donations', '_id' => 'LQE2-Z5C5-9718', 'rec' => 'tXK+8Hotr999G+XXMSx2pq+pkeZtf0ADE6fz3HzyHJUgEnntLQl2Eeq5xAkHKJz1NEAK3ChYQc2vJkKOjXpn/ac17XUKVpTt08uwZnR4WULVVpWRCYrHfYkEekeNY+E1sewIL5amsyIQ90R3SyudRQW9079QnBrrkkV/ErFHS8cQCyNJSQbbpPrKVHQjSJw2ZVQxoChHt6Q1+JH6EGcjA7M+68gN5G8g9YvA/lgrkqUAaCo1MUBL/5c/evnNys5FCcp69O6UcYtHi9RrX8biIA==', 'send_response' => null],
            ['type' => 'donations', '_id' => 'LQE3-0Z66-9521', 'rec' => 'UOYMC3xilIIorWwV6kOcKamjGBLrFBRiMAjmaXHv9gzOzVlV3cBYjBdkCaDKit3KjlZvfVNIKoXs49PdCNcnP8d2aNtVUZDKwQ+vRRf9Z0sjGOtcfEj34jb+eeh8nspyLnHhba7Y6ISqo1dl3GE5nLCzp5/ZmlQ8XD273smgxLSRK6t4R4b9QQYeXQj05FwblD1k1yKOdrdH4uk2HnFZ6rn6ucFbtXlQppCRhlDxze3adVLtitSJnVCK37M/eKIrEJRBrn9pZD2kQeuDOGVsNQ==', 'send_response' => null],
            ['type' => 'donations', '_id' => 'LQE3-2AXT-2909', 'rec' => 'ShehnwlY/qT6QZ5XcZ2j5TXjfgIy2FtDDCRik5NDK6Tncv3stKswft3gKgKjG7kIMO0r8pRXQr+nqEWvgWg5XeJ0neiLnU+HZya3NF6fiiKdnNeS5xLhFh2xCcU88k/iHkU4uDJRw/boV5ovqIf863X7V0FgV0gv4gP2hDm2rL0yaEghGJdDFy8wfsid4Lk0RwYRAkQ5/iOd1krt1pKufwPGMQWoShhkjGRYFUUieErkPM5BackD8O7iNWtRwEMqym3VDJDrABu5wuCNqYDf/w==', 'send_response' => null],
            ['type' => 'donations', '_id' => 'LQK6-04CR-4921', 'rec' => '3QgwJ4Djr8+BsmvF6oB1BySIadkREXd3sxyigfcoBmqQPg0kzU+eeK1bknbbri3Mtn2nS4vIO1ZpYWCB+6gfmXRFn9O8Q2b0JhRIGTiuILdEIouaea7gQsDq3nIYkIHz4hry9jP0uvevyApIzWnyeEDJcwuJESwPXcH2Yw94DLKoLW7/saKGWGZjVSMtanu28RQN7gwXLsd95YT10WLRpPywZ/4zkLGcrb6UCDDVgOljGNQlUkw/pV9IvlTYkjly', 'send_response' => null],
            ['type' => 'contacts', '_id' => 'LQK6-FGZJ-4112', 'rec' => 'D06HUfuKoQ64ihWbc6ualAtD2UgD0Z/PLSVBr2mHQfmJz5xrJZsILnCE9yyC0pa9zH3TcdiEAJ5pqh3w/CYZwDJzQQphVY5ZeLmfs/PfN0KSZe0KTh4YS7ZMesF5gKL6uJVaVqkB8dg/+YxEdsRq0QJ+3eFttPkt2QQNCfN7mS2NmB3RRHkD+qittA5J6j9TH6Qk30dhohcyD1pSlW/4JBoLx7w+g/HclyjeEO1cKvzeuOqwB8TKxUb2lgt/k9VXal5IN/yeWYIweqrifm/EsFyk3tN5+eZakn990drmGRgQCfrB240D5depk9Y1/ZdxGwRUx/I7I1AVtrb02xj1d8nMABR/Fmv3TMaAIVyo8Th9+oUnTvuj8kXBJ+BTjBeTZiMzPIMsoiHCM4DI0xiUcQ==', 'send_response' => null],
            ['type' => 'donations', '_id' => 'LQNU-KS2Z-2213', 'rec' => 'mR3EweCXXmzr2aB5yjAIJqRYv9bzh19Uvt9VJGVyb1C9HJRmIxDqDUznm68ripZ9dQM6LpMPMux7Vc9VDHcR80BnwwzOwRbaUd2Ca/Vlh6o36+gZkEe1FqHlBsMYx1snns3PpH1mb/C5G15Q49RRrRrnICzbrZtnobyqYOPkY/6hdZnt43FfF2oavj6Ms1ACuO6QlI2XCWY0B0aifB+fL+iil8kXEDsbAKsMN6UCWOnVe2qjX0tw68n6Cl3tdQipKR1si/U2ceuzhsRbGCOmDw==', 'send_response' => null],
            ['type' => 'contacts', '_id' => 'LQO5-1IIM-4295', 'rec' => 'SmgznZrjpqOHG9JhFG+Fztim/QNOmNOf4MFUis6k2oTT/PMxKiELE1Bkww+la4GLEzvykhzMSNCiYeJSuJSdYWanroFnJqSEMsypTs2Q/vKJOa/rQ0UybQWxYMp5qyXI4W54dhz0uw/uMLedSSUjF1SzR0fe1tSc2xDtNmOray8Vj+z5KVS0lSEBZE9ovgL0CddOgMA6bJebIxcD+QHrF2bey9xRHcyGnMZ/jn1F2gC1iz+tQwGqXQD/12BU8VyA4e7LZVamOitbhj04K0w1tZMGP3d9DAqX7YikDINqrSwrVfbJde7+PFCf34sMwYIimEzvGADpPLMwe5m+FKrQyCx1fNbJuYci/KSQwjhboKMMbnFx+YBqp1KUAWySczHR0UVSPnrK1WPzalG5H+U+o0zWcqX3shUy0+ppr7ZIjjI=', 'send_response' => null],
            ['type' => 'contacts', '_id' => 'LQO6-EO0L-9006', 'rec' => '0wq4PahOYmOeNZA9AIUFNsENdTgpyKpr+IwnYfadXuWERHPlbxt0jQgI3OegV4VXhxGYLWzw/VTdz/OfJk2JG7BksL/8n1yKqvJj1o1mwqzkP46CF7PLw7b1KvJRE2cMjltFBHwRl2TZYkSL+cvqSWLqB9IArWLZvVThGEzglupzQXUm3CxQrCQTe0z6WcEfuY5hlV1s8vbO9Fa6TnzapGhq7KBQVBvSS1Sy5OCWVZ2kVvoliu/3n2tlKmPyuhlfYk/iKry0jjhBWWc6COydDCTuw2VEMpgws0DkjTP71/o=', 'send_response' => null],
            ['type' => 'contacts', '_id' => 'LQO8-5TKL-4829', 'rec' => 'xpKl/LuutbFO09EAsMK4xzf6Mp4niexuIl4MpFtqTS07Zqpebzc4zDPSQJxrCWMF1pfrRv/24FX1AsMOdXOwXCxAKlktPSLzaTlwFmz7R8sZ75EquzYgukCgj+62L5ebr2bC/6xniy3VFubDdGRWyjLC6bzf5/2dG3r0WU8Odf9MgE7pP45g+1+4oBQrKYLN80Dk9av9gamy9dwYHakPl/IlLzSdLyunOrs+PxHE6oLMVlfOuHWwB8Z38Ojm5DSSkOsI73Hh3WYQdPJ77C+VN7CkTkB22Kd0OayCMdMx58dBcZTFt6LAQEiNoR4gjSXy', 'send_response' => null],
            ['type' => 'donations', '_id' => 'LQP8-ZJO7-4580', 'rec' => '/ginetMOuxuvKjrnpB073bulCsqiGfwN/n2CYCJN6hakAw+W1ZUNN66Q2XHamUlz3lusHCfkFg9EgS08Ev1WBPr8RfNKx5/oAxtDbY0WHHvm0KZNeT8pXvlyyn9jR7XWlFm1TlgBBBaQAd6afiN1vYiDg9ILGK96DIWFxZrZtX2ikZdalUdkG15HCguiikm2uqkrbMYIqylniYJduRs5fScjhUSlMV9fMSrzKwyt/k0=', 'send_response' => null],
            ['type' => 'legacy_giving', '_id' => 'LQP9-0G3A-8616', 'rec' => 'Gp80wR4PBvBfX3wlx9ynBjlPDiH5OiUUBkqiAUEurxLypOp6TEJYvyoxjYGu2w3N6+eeRKsjYAk1oUBJKH5WhMBzsjBxo2FF1ZNgziMLeFsVN1a8AIXPPNaVi/clQyZtE+SHfCOOVAOJ0kitkSvS3w3/uBGRCQOmytYyxGIbd1++P2P8y72EmQ0uNZkwGcbsX6SoC1TJvTX6tZQDyFd0+200hy2CE86hepK7RSa+8h46qkEVpPMGe121Hm/TO/1FPDbCi+u4Q3/dZ201nlfrShIyXdCLDMD2SLq6kZLSsR9YqFhpqlfjl5mwt21FJA4kEoU6FHg2YP4pK9kF2BZP5s9z9d5EHZkz0tY9CNXUtsqA4XKGLW2WiCys5qDVNYS5cjUr++VUg4/BOh93lgR3ATIp+O+g2Tk94/mhXVbju7o=', 'send_response' => null],
            ['type' => 'contacts', '_id' => 'LQP9-1RYE-5909', 'rec' => 'm9/MH6gj+ZjmzFpdtd65uWA/om93a9PgAqS/CHpWZ4afuTCXuPAdNhAhb5GBMxBHhxG1LaUgb8n0HlBHPyqpjcn7yPUqyOjHleBWEZ+fvDyOGQQ7xuMi00T3wuif+MYWbl2NNxAQ+Z3uaVf1Xr0xSNlma0sr5yx0SYSjE52OH3JFP0+plI4hNX+5HHv6Rr7Yc3SCB2Zty1lVSmc9bPE/biJgGA0vYoY6dx7lBMhoNk5F+vRN4vHhmrPw+3Poqy7i', 'send_response' => null],
            ['type' => 'donations', '_id' => 'LQPA-8X7Z-8611', 'rec' => 'Xe18/2LWoqH2AUPEe21kC8pE5PX/cCzlrnA5aAa4K+ryWciWzYusnHzHG3eV4v94g+MmeVK9mlI0ZFGIs/Da2P/OJZZvHhpPmuGCx0oyaNsGbEmEO7ake7bN1sOcjzqSj9RZrkbF2OM+7bUSveN/1m9mFCRNBeF2GtX4VETwwvNCWPsSzQpYmx/JCu1tfpA466ozzuDQN5c/lhnIaxITeh7EEDEz96P+czSCYG2oyqg=', 'send_response' => null],
            ['type' => 'contacts', '_id' => 'LQZD-8477-3312', 'rec' => 'MNWe/1+7ZoxWwMh6TM0iPko90x0HpXpbu/EyRVTyTW9gm28Iuis7D/SyPJywBWNBVHQZBoGtdrta3WldjIE/vTsVFUsrRIR4UH6qHqk9O1+2lMnvzV36OHK3tjV42LKE9I8VBSHSq5c3K0Yln33g5eW0B0CLczq/dROxr2Ox5Oxi+cgryKqba2MAZTKAyez3wq8XsMRoh2JxwntzNbHaCAd7DPt7m74ZLWU7DYYr1r6shyfBwTfsGzOMrpN+JFhsN88fYt68RyOrnamXvEaSMrcOIbXgUuomCgwhRloDKXyt8sIz87zYjs4fEAXbr93LDxJZ5HSVmP0y/hbTJXnnK3bpUU+OD3sMVadJ+YOWhSVSSo1pNYKNlkm8r8cXb84rCmiz3SB4bBUxO6wJIGfCMozjOzbSkC1e57P6ecxky21VSVcKrZdAIJIzeVI493lkf41lzQrrRHijPqnbyUIbV3ucfYJz5NtytrWyJNNvF59rpzvonV/hPxpVrB0yoja1VELMFDeXJ1L08GVOHAsmZA==', 'send_response' => null],
        ];

        foreach ($data as $record) {
            DB::table('submitted_data')->insert(array_merge($record, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
