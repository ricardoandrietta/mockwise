declare(strict_types=1);

namespace MockWise\Application\DTOs\Schema;

class SaveSchemaDTO
{
    public function __construct(
        private readonly int $userId,
        private readonly string $name,
        private readonly array $content,
        private readonly string $description,
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): array
    {
        return $this->content;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
} 