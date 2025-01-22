<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productNames = [
            'Smartphone Pro Max',
            'Wireless Earbuds',
            'Gaming Keyboard',
            'Ultra HD Monitor',
            'Electric Kettle',
            'Portable Speaker',
            'Fitness Tracker',
            'LED Desk Lamp',
            'Smartwatch Series 7',
            'Noise-Cancelling Headphones',
            'Bluetooth Mouse',
            '4K Action Camera',
            'Portable Charger',
            'Smart Home Hub',
            'Electric Toothbrush',
            'Robot Vacuum Cleaner',
            'Wireless Router',
            'Digital Photo Frame',
            'Smart Light Bulb',
            'VR Headset',
            'Noise-Cancelling Earbuds',
            'Smart Thermostat',
            'Portable Projector',
            'Electric Scooter',
            'Smart Doorbell',
            'Fitness Smart Scale',
            'Smart Air Purifier',
            'Wireless Charging Pad',
            'Smart Coffee Maker',
            'Home Security Camera'
        ];

        return [
            'product' => $this->faker->randomElement($productNames),
            'quantity' => $this->faker->numberBetween(1, 10),
            'total' => $this->faker->randomFloat(2, 10, 1000),
            'user_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
