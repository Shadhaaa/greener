<?php

namespace App\Test\Controller;

use App\Entity\Commande;
use App\Entity\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommandeControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private CommandeRepository $repository;
    private string $path = '/commande/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Commande::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Commande index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'commande[clientId]' => 'Testing',
            'commande[dateCommande]' => 'Testing',
            'commande[montantTotal]' => 'Testing',
            'commande[adresseLivraison]' => 'Testing',
            'commande[dateLivraison]' => 'Testing',
            'commande[modePaiement]' => 'Testing',
            'commande[panierid]' => 'Testing',
        ]);

        self::assertResponseRedirects('/commande/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Commande();
        $fixture->setClientId('My Title');
        $fixture->setDateCommande('My Title');
        $fixture->setMontantTotal('My Title');
        $fixture->setAdresseLivraison('My Title');
        $fixture->setDateLivraison('My Title');
        $fixture->setModePaiement('My Title');
        $fixture->setPanierid('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Commande');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Commande();
        $fixture->setClientId('My Title');
        $fixture->setDateCommande('My Title');
        $fixture->setMontantTotal('My Title');
        $fixture->setAdresseLivraison('My Title');
        $fixture->setDateLivraison('My Title');
        $fixture->setModePaiement('My Title');
        $fixture->setPanierid('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'commande[clientId]' => 'Something New',
            'commande[dateCommande]' => 'Something New',
            'commande[montantTotal]' => 'Something New',
            'commande[adresseLivraison]' => 'Something New',
            'commande[dateLivraison]' => 'Something New',
            'commande[modePaiement]' => 'Something New',
            'commande[panierid]' => 'Something New',
        ]);

        self::assertResponseRedirects('/commande/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getClientId());
        self::assertSame('Something New', $fixture[0]->getDateCommande());
        self::assertSame('Something New', $fixture[0]->getMontantTotal());
        self::assertSame('Something New', $fixture[0]->getAdresseLivraison());
        self::assertSame('Something New', $fixture[0]->getDateLivraison());
        self::assertSame('Something New', $fixture[0]->getModePaiement());
        self::assertSame('Something New', $fixture[0]->getPanierid());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Commande();
        $fixture->setClientId('My Title');
        $fixture->setDateCommande('My Title');
        $fixture->setMontantTotal('My Title');
        $fixture->setAdresseLivraison('My Title');
        $fixture->setDateLivraison('My Title');
        $fixture->setModePaiement('My Title');
        $fixture->setPanierid('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/commande/');
    }
}
