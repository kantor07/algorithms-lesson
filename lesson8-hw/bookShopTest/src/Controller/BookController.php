<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Image;
use App\Entity\Author;
use App\Entity\PublishingHouses;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{

    #[Route('/book/{book_id}', name: 'book')]
    public function getBook($book_id, ManagerRegistry $managerRegistry) : Response
    {
        $manager = $managerRegistry->getRepository(Book::class);
        $book = $manager->find($book_id);
    //        return $this->render('book/index.html.twig', [
    //            'controller_name' => 'BookController',
    //        ]);
        foreach ($book->getImages() as $image)
            {
                echo  '<img class= "img" src="' . $image->getPath() . '"wight = 33% height = 200</br>';
            }

        foreach ($book->getAuthors() as $author)
            {
                echo '<h1> Автор: '. ($author->getName()) . ' ' . ($author->getSurname()) . '</h1><br>';
        
            }
        
        echo '<h2> Название: '. ($book->getTitle()) . '</h2><br>';
        echo '<h3> Описание: '. ($book->getDescription()) . '</h3><br>';
        echo '<h3> Издательство: '. ($book->getPublishingHouses()->getName()) . '</h3><br>';
        echo '<h4> '. ($book->getPublishingHouses()->getCity()) . '</h4><br>';
        echo '<h4> Цена за единицу: '. ($book->getPrice()) . ' рублей </h4>';
        die();
        
    }
    
    public function insertBook(ManagerRegistry $managerRegistry)
    {
        $manager=$managerRegistry->getManager();
        $image1 = new Image();
        $image1->setPath('/images/Таинственный остров Жюль Верн.jpg');
        $image2 = new Image();
        $image2->setPath('/images/Харка — сын вождя Генрих Лиззелота.jpg');

        $author1 = new Author();
        $author1->setName('Лизелотта');
        $author1->setSurname('Вельскопф-Генрих');
        $author1->setDescription('Немецкая писательница и историк, автор многочисленных приключенческих романов о жизни североамериканских индейцев.');

        $publishingHouses1 = new PublishingHouses();
        $publishingHouses1->setName('ФТМ');
        $publishingHouses1->setCity('Москва');

        $publishingHouses2 = new PublishingHouses();
        $publishingHouses2->setName('Детская литература');
        $publishingHouses2->setCity('Москва');

        $book1 = new Book();
        $book1->setTitle('Таинственный остров');
        $book1->setDescription('Во времена гражданской войны в США пятеро смельчаков-северян спасаются от плена на воздушном шаре. Страшная буря выбрасывает
        их на берег необитаемого острова. Отвага и таланты новых поселенцев острова помогают им обустроить свою жизнь, не испытывая 
        нужды ни в еде, ни в одежде, ни в тепле и уюте. Мирное пребывание «робинзонов» на острове нарушает угроза нападения пиратов, 
        но какая-то таинственная сила помогает им в самых сложных ситуациях.о');
        $book1->setPrice(999.98);
    
        $book2 = new Book();
        $book2->setTitle('Харка — сын вождя');
        $book2->setDescription('Приключенческий роман «Харка — сын вождя» немецкой писательницы Лизелотты Вельскопф-Генрих посвящен жизни и борьбе индейцев 
        Северной Америки за свои права и свободу во второй половине XIX века. Это первый роман из цикла «Сыновья Большой Медведицы».');
        $book2->setPrice(1999);

        $image1->setBook($book1);
        $image2->setBook($book2);
        $book1->addImage($image1);
        $book2->addImage($image2);

        $author1->addBooksId($book2);
        $book2->addAuthor($author1);

        $publishingHouses1->addBookId($book1);
        $publishingHouses2->addBookId($book2);
        $book1->setPublishingHouses($publishingHouses1);
        $book2->setPublishingHouses($publishingHouses2);
    
        $manager->persist($image1);
        $manager->persist($image2);
        $manager->persist($author1);
        $manager->persist($publishingHouses1);
        $manager->persist($publishingHouses2);
        $manager->persist($book1);
        $manager->persist($book2);
        $manager->flush();
    }
    
}

