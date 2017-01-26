<%@ Page Title="" Language="C#" MasterPageFile="~/master.Master" AutoEventWireup="true" CodeBehind="cadastro2.aspx.cs" Inherits="atPratica03_09.cadastro2" %>
<asp:Content ID="Content1" ContentPlaceHolderID="head" runat="server">
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="ContentPlaceHolder1" runat="server">
    <h1>Página de Cadastro2</h1>
    <br />
    <asp:Label ID="Label2" runat="server" Text="Nome"></asp:Label>
    <asp:TextBox ID="txtNome" runat="server"></asp:TextBox>
      <asp:Label ID="erroNome" runat="server" Text=""></asp:Label>
   
    <br />
    <asp:Label ID="label6" runat="server" Text="Idade"></asp:Label>
    <asp:TextBox ID="txtIdade" runat="server" Text ="0"></asp:TextBox>
     <asp:Label ID="erroIdade" runat="server" Text=""></asp:Label>
    <br />
    <asp:Label ID="label7" runat="server" Text="Sexo"></asp:Label>
    <asp:DropDownList ID="DropDownList1" runat="server">
        <asp:ListItem Selected="True">Masculino</asp:ListItem>
        <asp:ListItem>Feminino</asp:ListItem>
       
    </asp:DropDownList>
    <br />
    <asp:Label ID="Label3" runat="server" Text="E-mail"></asp:Label>
    <asp:TextBox ID="txtEmail" runat="server"></asp:TextBox>
      <asp:Label ID="erroEmail" runat="server" Text=""></asp:Label>
  
    <br />
    <asp:Label ID="Label1" runat="server" Text="Login"></asp:Label>
    <asp:TextBox ID="txtLogin" runat="server"></asp:TextBox>
     <asp:Label ID="erroLogin" runat="server" Text=""></asp:Label>
    <br />
    <asp:Label ID="Label4" runat="server" Text="Senha"></asp:Label>
    <asp:TextBox ID="txtSenha" runat="server"></asp:TextBox>
      <asp:Label ID="erroSenha" runat="server" Text=""></asp:Label>
    <br />
    <asp:Label ID="Label5" runat="server" Text="Confirma Senha"></asp:Label>
    <asp:TextBox ID="txtConfirmaSenha" runat="server"></asp:TextBox>
    <asp:Label ID="erroConfirmaSenha" runat="server" Text=""></asp:Label>
    <br />
    <asp:ImageButton ID="btnCadastrar" runat="server" ImageUrl="~/img/disk_blue_ok.png" OnClick="btnCadastrar_Click" />
    <br />
    <asp:Label ID="LabelMensagem" runat="server" Text="..."></asp:Label>
    <br />

</asp:Content>
