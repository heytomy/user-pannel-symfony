<?php

namespace App\Controller;

use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

class ProfileController extends AbstractController
{
    # TODO: Ne fonctionne pas voir plus tard..
    
    #[Route('/profile', name: 'app_profile')]
    public function settings(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder)
    {
        $user = $this->getUser();

        $form = $this->createFormBuilder($user)
            ->add('email', EmailType::class)
            ->add('currentPassword', PasswordType::class, [
                'mapped' => false,
                'required' => true,
                'attr' => ['autocomplete' => 'off'],
            ])
            ->add('newPassword', PasswordType::class, [
                'mapped' => false,
                'required' => true,
                'attr' => ['autocomplete' => 'off'],
            ])
            ->add('newPasswordConfirm', PasswordType::class, [
                'mapped' => false,
                'required' => true,
                'attr' => ['autocomplete' => 'off'],
                'label' => 'Confirm new password',
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

        // Validate the current password
        if (!$passwordEncoder->isPasswordValid($user, $data['currentPassword'])) {
            $form->get('currentPassword')->addError(new FormError('Invalid password.'));
            return $this->render('profile/settings.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        }

        // Validate the new passwords
        if ($data['newPassword'] !== $data['newPasswordConfirm']) {
            $form->get('newPassword')->addError(new FormError('Passwords do not match.'));
            return $this->render('profile/settings.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        }

        // Update the user entity with the new email address, if changed
        if ($data['email'] !== $user->getEmail()) {
            $user->setEmail($data['email']);
            $entityManager->flush();
        }

        // Update the user entity with the new password, if changed
        if (!empty($data['newPassword'])) {
            $user->setPassword($passwordEncoder->encodePassword($user, $data['newPassword']));
            $entityManager->flush();
        }

        // Redirect the user back to the settings page with a success message
        $this->addFlash('success', 'Your profile has been updated successfully.');
        return $this->redirectToRoute('profile_settings');
    }

    return $this->render('profile/settings.html.twig', [
        'user' => $user,
        'form' => $form->createView(),
    ]);
    }
}
