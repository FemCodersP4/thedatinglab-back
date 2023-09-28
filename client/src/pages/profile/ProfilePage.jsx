import React, { useEffect, useState } from 'react';
import './ProfilePage.css';
import Navbar from '../../components/navbar/Navbar';
import NavbarLogin from '../../components/navbar/NavbarLogin';
import Footer from '../../components/footer/Footer';
import { useNavigate, useParams, Link } from 'react-router-dom';
import { ProfileService } from '../../service/ProfileService';
import Swal from 'sweetalert2';
import ProfileEditForm from '../../components/forms/ProfileEditForm';

function ProfilePage() {
  const navigate = useNavigate();
  const { id } = useParams();
  const [profile, setProfile] = useState(null);
  const [isEditing, setIsEditing] = useState(false);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const profileService = ProfileService();
        const response = await profileService.getProfile(id);
        console.log(response);
        setProfile(response.profile);
      } catch (error) {
        console.log(error);
      }
    };

    fetchData();
  }, [id]);

const userName = profile && profile.user ? profile.user.name : '';

  return (
    <div className='profile-container'>
      <Navbar />
      <div className='match-container'>
        <h1 className='match-title'>¡Hola, {userName}!</h1>
        <center>
          <div className="match-profile" style={{ width: '18rem'}}>
            <div className="card-img-top">
              <center><img src={`http://localhost:8000/storage/${profile && profile.image}`} className="rounded-circle" alt={`Tu foto de perfil`} /></center>
            </div>
            <div className="match-body">
              <p className="preference-text"><small>{profile && profile.description}</small></p>
            </div>
          </div>
        </center>
        <center>
          <button type="button" className="button-cancel" onClick={() => setIsEditing(!isEditing)}>
            {isEditing ? 'Cancelar' : 'Editar'}
          </button>
        </center>
        {isEditing && (
          <ProfileEditForm profile={profile} id={id} setIsEditing={setIsEditing} />
        )}
      </div>
      <NavbarLogin />
     
    </div>
  );
}

export default ProfilePage;
