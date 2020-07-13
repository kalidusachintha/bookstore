<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\BooksCategory;
use App\Entity\Books;

class Data extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $booksCategory1 = new BooksCategory();
        $booksCategory1->setCategoryName('Fiction');
        $booksCategory1->setStatus(1);
        $manager->persist($booksCategory1);

        $booksCategory2 = new BooksCategory();
        $booksCategory2->setCategoryName('Children');
        $booksCategory2->setStatus(1);
        $manager->persist($booksCategory2);

        $booksCategory3 = new BooksCategory();
        $booksCategory3->setCategoryName('Anthology');
        $booksCategory3->setStatus(1);
        $manager->persist($booksCategory3);

        $booksCategory4 = new BooksCategory();
        $booksCategory4->setCategoryName('Crime and Detective');
        $booksCategory4->setStatus(1);
        $manager->persist($booksCategory4);

        $book1 = new Books();
        $book1->setBooksCategory($booksCategory2);
        $book1->setBookName('Paint by Sticker Kids');
        $book1->setStatus(1);
        $book1->setPrice(3.99);
        $book1->setDescription('Paint by Sticker Kids: Unicorns & Magic includes everything kids need to create ten vibrant images, including unicorns, a dragon, a princess, and more.');
        $book1->setBookImage('shorturl.at/ovx19');
        $book1->setStock(50);
        $book1->setAddedDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $manager->persist($book1);

        $book2 = new Books();
        $book2->setBooksCategory($booksCategory2);
        $book2->setBookName('My First Learn to Write Workbook');
        $book2->setStatus(1);
        $book2->setPrice(3.99);
        $book2->setDescription('Set kids up to succeed in school with a learn to write for kids guide that teaches them letters, shapes, and numbers―and makes it fun. My First Learn-to-Write Workbook introduces your early writer to proper pen control, steady line tracing, new words.');
        $book2->setBookImage('shorturl.at/psLP8');
        $book2->setStock(50);
        $book2->setAddedDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $manager->persist($book2);

        $book3 = new Books();
        $book3->setBooksCategory($booksCategory1);
        $book3->setBookName('The Dancing Girls');
        $book3->setStatus(1);
        $book3->setPrice(3.99);
        $book3->setDescription('Loved it, loved it, loved it!!... If I could give it 6 stars I would! In this current climate of ‘twists you will never see coming’ – believe me... you will never see this coming!... Cannot wait for the next book');
        $book3->setBookImage('shorturl.at/bjuRX');
        $book3->setStock(50);
        $book3->setAddedDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $manager->persist($book3);

        $book4 = new Books();
        $book4->setBooksCategory($booksCategory1);
        $book4->setBookName('Sold on a Monday');
        $book4->setStatus(1);
        $book4->setPrice(3.99);
        $book4->setDescription('An unforgettable historical fiction novel by Kristina McMorris, inspired by a stunning piece of history from Depression-Era America.');
        $book4->setBookImage('shorturl.at/iptx4');
        $book4->setStock(50);
        $book4->setAddedDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $manager->persist($book4);

        $book5 = new Books();
        $book5->setBooksCategory($booksCategory3);
        $book5->setBookName('The Norton Anthology of American Literature');
        $book5->setStatus(1);
        $book5->setPrice(3.99);
        $book5->setDescription('The most-trusted anthology for complete works, balanced selections, and helpful editorial apparatus, The Norton Anthology of American Literature features a cover-to-cover revision');
        $book5->setBookImage('shorturl.at/oxNST');
        $book5->setStock(50);
        $book5->setAddedDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $manager->persist($book5);

        $book6 = new Books();
        $book6->setBooksCategory($booksCategory3);
        $book6->setBookName('Literature: A Portable Anthology');
        $book6->setStatus(1);
        $book6->setPrice(14.99);
        $book6->setDescription('Combining classic and contemporary fiction, poetry, and drama, Literature: A Portable Anthology is an affordable collection of writing from a variety of authors, including Edgar Allan Poe');
        $book6->setBookImage('shorturl.at/dgCDW');
        $book6->setStock(50);
        $book6->setAddedDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $manager->persist($book6);

        $book7 = new Books();
        $book7->setBooksCategory($booksCategory4);
        $book7->setBookName('The Shop Window Murders (Detective Club Crime Classics)');
        $book7->setStatus(1);
        $book7->setPrice(16.99);
        $book7->setDescription('The delight of Christmas shoppers at the unveiling of a London department store’s famous window display turns to horror when one of the mannequins is discovered to be a dead body…');
        $book7->setBookImage('shorturl.at/stDJ0');
        $book7->setStock(50);
        $book7->setAddedDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $manager->persist($book7);

        $book8 = new Books();
        $book8->setBooksCategory($booksCategory4);
        $book8->setBookName('Beware of Johnny Washington: Based on ‘Send for Paul Temple');
        $book8->setStatus(1);
        $book8->setPrice(14.99);
        $book8->setDescription('Republished for the first time since 1951, Beware of Johnny Washington is Francis Durbridge’s clever reworking of the very first Paul Temple radio serial using his new characters, the amiable Johnny Washington and newspaper columnist Verity Glyn.');
        $book8->setBookImage('shorturl.at/btzKU');
        $book8->setStock(50);
        $book8->setAddedDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $manager->persist($book8);

        $book9 = new Books();
        $book9->setBooksCategory($booksCategory4);
        $book9->setBookName('Called Back (Detective Club Crime Classics)');
        $book9->setStatus(1);
        $book9->setPrice(14.99);
        $book9->setDescription('The first in a new series of classic detective stories from the vaults of HarperCollins involves a blind man who stumbles across a murder. As he has not seen anything, the assassins let him go, but he finds it is impossible to walk away from murder.');
        $book9->setBookImage('shorturl.at/emsBH');
        $book9->setStock(50);
        $book9->setAddedDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $manager->persist($book9);

        $book10 = new Books();
        $book10->setBooksCategory($booksCategory1);
        $book10->setBookName('The Silent Wife: A gripping, emotional page-turner with a twist that will take your breath away');
        $book10->setStatus(1);
        $book10->setPrice(12.99);
        $book10->setDescription('In this heart-wrenching, emotionally gripping USA Today bestseller, a woman with a seemingly perfect life finds a mysterious letter that reveals dark secrets from the past that threaten to destroy her family.');
        $book10->setBookImage('shorturl.at/hirI0');
        $book10->setStock(50);
        $book10->setAddedDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $manager->persist($book10);

        $book11 = new Books();
        $book11->setBooksCategory($booksCategory2);
        $book11->setBookName('The Girl Who Drank the Moon (Winner of the 2017 Newbery Medal)');
        $book11->setStatus(1);
        $book11->setPrice(12.99);
        $book11->setDescription('Every year, the people of the Protectorate leave a baby as an offering to the witch who lives in the forest. They hope this sacrifice will keep her from terrorizing their town. But the witch in the Forest, Xan, is kind');
        $book11->setBookImage('shorturl.at/dfm19');
        $book11->setStock(50);
        $book11->setAddedDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $manager->persist($book11);

        $book12 = new Books();
        $book12->setBooksCategory($booksCategory3);
        $book12->setBookName('Jimmy Page: The Anthology');
        $book12->setStatus(1);
        $book12->setPrice(12.99);
        $book12->setDescription('From his early days as a young session musician, through his years on the world stage with Led Zeppelin, to his solo work and collaborations, Jimmy Page has lived a spectacular life in music.');
        $book12->setBookImage('shorturl.at/dhnqO');
        $book12->setStock(50);
        $book12->setAddedDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $manager->persist($book12);



        $manager->flush();
    }
}
